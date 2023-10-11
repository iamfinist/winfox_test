<script>
export default {
    name: 'App',
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title = to.meta.title || 'Hello World';
            }
        },
    }
};
</script>

<template>
  <div class="App">
      <router-view/>
  </div>
</template>

<style scoped>

</style>
