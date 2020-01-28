<template>
  <div class="container">
    <ul>
      <li>
        <router-link to="/">
          Giriş
        </router-link>
      </li>
      <li>
        <router-link to="/todos">
          Yapılacaklar
        </router-link>
      </li>
    </ul>
    <router-view></router-view>
  </div>
</template>

<script>

  export default {
  };
</script>

<style>
.completed {
  text-decoration: line-through;
}
</style>
