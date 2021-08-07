<template>
  <div class="container">
      <mcv-top-bar/>
  </div>
    <router-view :key="$route.path" />
</template>

<script>
import McvTopBar from "@/components/TopBar";
import {actionTypes} from "@/store/modules/auth";

export default {
    name: 'McvApp',
    components: {McvTopBar},
    mounted() {
        this.$store.dispatch(actionTypes.getCurrentUser)
    }
}
</script>

<style lang="scss">

</style>
