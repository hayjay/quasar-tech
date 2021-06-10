<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />

        <q-toolbar-title>
          Quasar Listings App 
        </q-toolbar-title>

        <div>{{ user.name }}</div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      content-class="bg-grey-1"
    >
      <q-list>
        <q-item-label
          header
          class="text-grey-8"
        >
          Admin Dashboard
        </q-item-label>
        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
        <q-item clickable v-ripple>
          <q-icon name="logout" /><q-item-section icon="logout" @click.prevent="signOut">Logout</q-item-section>
        </q-item>
        <!-- <q-btn color="white" text-color="black" label="Logout"></q-btn> -->
      </q-list>
    </q-drawer>
    <q-page-container>
      
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import EssentialLink from 'components/EssentialLink.vue'

const linksData = [
  {
    title: 'Lists',
    caption: 'To view all lists, click here.',
    icon: 'list',
    link: '/list/all'
  },
  {
    title: 'Add Lists',
    caption: 'To add new list, click here.',
    icon: 'add_circle',
    link: '/list/create'
  },
  // {
  //   title: 'Find List By ID',
  //   caption: 'To find a specific list, click here.',
  //   icon: 'chat',
  //   link: '/list/create'
  // },
  {
    title: 'Transaction Log',
    caption: 'View all activity log.',
    icon: 'chat',
    link: '/user/transaction-log'
  },
];

export default {
  name: 'MainLayout',
  components: { EssentialLink },
  data () {
    return {
      leftDrawerOpen: false,
      essentialLinks: linksData
    }
  },
  
  methods: {
    ...mapActions({
      signOutAction: 'auth/signOut'
    }),

    async signOut() {
      await this.signOutAction();
      this.$q.notify({
          icon: 'done',
          color: 'positive',
          message: `Logged Out!`
      });
      this.$router.push('/');
    }
  }, 

  computed: {
      ...mapGetters({
        authenticated: 'auth/authenticated',
        user: 'auth/user',
      })
  }
}
</script>
