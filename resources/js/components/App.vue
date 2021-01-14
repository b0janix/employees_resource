<template>
    <login :errors="errors" v-if="ifAuth"></login>
    <home v-else
          :route="route"
          :csrf="csrf"
          :client_id="client_id"
          :redirect_uri="redirect_uri"
          :errors="errors"
    >

    </home>
</template>

<script>
import Login from "./Login";
import Home from "./Home";
export default {
    name: "App",
    props: [
        'errormsg',
        'auth',
        'route',
        'csrf',
        'client_id',
        'redirect_uri'
    ],
    data() {
      return {
          errors: this.errormsg
      }
    },
    components: {
        Login,
        Home
    },
    computed: {
        ifAuth() {
            return this.auth !== '1'
        }
    },
    mounted() {

    }
}
</script>

<style scoped>

</style>
