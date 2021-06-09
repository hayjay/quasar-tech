
<template>
  <div id="q-app">
    <router-view />
  </div>
</template>
<script>
import { mapActions } from 'vuex'

export default {
  name: 'App',

  methods: {
    ...mapActions({
            auth: 'auth/me'
        }),
  },
  created() {
    //helps in retaining the state (data) on page refresh, so this gets called before anything in the app.
    this.auth().then(_ => {});
  }
}

</script>
