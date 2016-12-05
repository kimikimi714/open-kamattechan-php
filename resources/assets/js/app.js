
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('comment', require('./components/Comment.vue'));
Vue.component('rank', require('./components/Rank.vue'));
Vue.component('rank-header', require('./components/RankHeader.vue'));
Vue.component('list', require('./components/List.vue'));

const app = new Vue({
  el: '#app',
  data: {
    type: 'weekly',
    rankings: [],
  },
  created: function() {
    // GET request
    var self = this
    this.$http.get('http://localhost:8000/api/rankings').then((resource) => {
      this.type = resource.body.type
      this.rankings = resource.body.rankings
    }, (resource) => {
      // handle error
    })
  }
});
