<template>
  <div class="d-flex justify-content-start mb-2">
    <h2 class="me-5">Payments for {{currentPaymentsUser.name}}</h2>
    <button class="btn btn-outline-danger btn-sm ml-auto p-2" @click="goBack">Back to users</button>
  </div>
  <nav aria-label="page-navigation">
    <ul class="pagination">
      <li v-bind:class="[{ disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchPayments(pagination.prev_page_url)">Previous</a></li>
      <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
      <li v-bind:class="[{ disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchPayments(pagination.next_page_url)">Next</a></li>
    </ul>
  </nav>
  <div class="card card-body mb-2" v-for="payment in payments" v-bind:key="payment.id">
    <h3>{{ payment.amount }}</h3>
    <span>Purpose: {{ payment.purpose }}</span>
    <span>Date: {{ payment.created_at.substring(0,10) }}</span>
  </div>
</template>
<script>
export default {
  data() {
    return {
      currentUser: {},
      currentPaymentsUser: {},
      user_id: localStorage.getItem('paymentsUserId') ?? null,
      token: localStorage.getItem('token'),
      payments: [],
      payment: {
        id: '',
        amount: '',
        purpose: '',
        created_at: '',
      },
      payment_id: '',
      pagination: {},
    }
  },
  mounted(){
    fetch('api/user',{ headers:{'Authorization':`Bearer ${this.token}`,'Accept':'application/json','Content-Type':'application/json'}}).then(
        response => response.json()).then( response => {
      this.currentUser.name = response.name ?? null;
      this.currentUser.email = response.email ?? null;
      if (!this.currentUser.name) { this.$router.push('/') }

      fetch(`api/users/${this.user_id}`,{ headers:{'Authorization':`Bearer ${this.token}`,'Accept':'application/json','Content-Type':'application/json'}}).then(
          response => response.json()).then( response => {
          if (response.data){
            this.currentPaymentsUser.name = response.data[0].name ?? null;
            this.currentPaymentsUser.email = response.data[0].email ?? null;
          }
      }).catch(err=>console.log(err))

    }).catch(err=>console.log(err))

  },
  created() {
    this.fetchPayments();
  },
  methods: {
    fetchPayments(page_url){
      if (!this.user_id) { return; }
      page_url = page_url || `api/users/${this.user_id}/payments`;
      fetch(page_url, {
        headers: { 'Authorization':`Bearer ${this.token}`, 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-XSRF-TOKEN': this.getCookie('XSRF-TOKEN').slice(0,-2) }
      }).then(res => res.json()).then(res => {
        this.payments = res.data;
        if (res.meta && res.links){
          this.makePagination(res.meta, res.links);
        }
      }).catch(err => console.log(err));
    },
    makePagination(meta, links){
      this.pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev,
      };
    },
    goBack(){
      this.$router.push('/users')
    },
    getCookie(name){
      let cookie = {};
      document.cookie.split(';').forEach(function(el) {
        let [key,value] = el.split('=');
        cookie[key.trim()] = value;
      })
      return cookie[name];
    }
  }
};
</script>
