<template>
  <v-app
    dark
    id="inspire"
  >
    <v-navigation-drawer
      persistent
      clipped
      enable-resize-watcher
      v-model="drawer"
      app
    >
      <v-list dense>
        <v-subheader class="mt-3 grey--text text--darken-1">ВНУТРИ МЕНЮШКА</v-subheader>
        <v-list>
          <v-list-tile v-for="item in drawerMenu" v-bind:key="item.title">
            <v-list-tile-avatar>
              <v-icon v-if="item.icon" >{{item.icon}}</v-icon>
            </v-list-tile-avatar>
            <v-list-tile-content>
              <router-link :to="item.href">{{item.title}}</router-link>
            </v-list-tile-content>
        
          </v-list-tile>
         </v-list>



        <v-list-tile class="mt-3" @click="">
          <v-list-tile-action>
            <v-icon color="grey darken-1">add_circle_outline</v-icon>
          </v-list-tile-action>
          <v-list-tile-title class="grey--text text--darken-1">Browse Channels</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click="">
          <v-list-tile-action>
            <v-icon color="grey darken-1">settings</v-icon>
          </v-list-tile-action>
          <v-list-tile-title class="grey--text text--darken-1">Manage Subscriptions</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar color="blue" dense fixed clipped-left app>
      <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
       
      </v-toolbar-title>
       <v-spacer></v-spacer>

      <v-spacer></v-spacer>
      <v-layout row align-center style="max-width: 650px">
        <v-text-field
          placeholder="Search..."
          single-line
          append-icon="search"
          :append-icon-cb="() => {}"
          class="white--text"
          hide-details
        ></v-text-field>
      </v-layout>
      <v-spacer></v-spacer>
        <v-btn icon>
        <v-icon>apps</v-icon>
      </v-btn>
      <v-btn icon>
          <v-badge color="red">
          <span slot="badge">6</span>
          <v-icon>notifications</v-icon>
        </v-badge>
     
      </v-btn>
      <v-btn icon large>
       <v-avatar size="40px" tile>
          <img
            src="../assets/logo.png"
            alt="FJV"
          >
        </v-avatar>
      </v-btn>
    </v-toolbar>
    <main>
      <v-content>
          <v-container fill-height>
            
          <v-layout justify-center align-center>
         <router-view/>
           
          </v-layout>
        </v-container>
      
      </v-content>
    </main>
  </v-app>
</template>

<script>
export default {
  name: 'Main',
  data: () => ({
    drawer: true,
    drawerMenu: [
      {
        icon: 'home',
        title: 'Домашняя',
        href: '/'
      },
      {
        icon: 'build',
        title: 'Админка',
        href: '/admin'
      }
    ]
  }),
  props: {
    source: String
  }
}
</script>


<style scoped>
.input-group__details:after {
  background-color: rgba(255, 255, 255, 0.32) !important;
}
.list__tile__content a {
  text-decoration: none;
}
</style>