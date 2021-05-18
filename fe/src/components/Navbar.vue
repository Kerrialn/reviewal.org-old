<template>
  <div>
    <b-navbar>
      <template #brand>
        <b-navbar-item tag="router-link" :to="{ name: 'Home' }">
          <b>Reviewal</b>
        </b-navbar-item>
      </template>

      <template #start>
        <b-navbar-item tag="router-link" :to="{ name: 'Create' }">
          Create
        </b-navbar-item>
      </template>

      <template #end>
        <b-navbar-item tag="router-link" :to="{ name: 'Register' }">
          Register
        </b-navbar-item>
        <b-navbar-item tag="router-link" :to="{ name: 'Login' }">
          Login
        </b-navbar-item>
      </template>
    </b-navbar>
  </div>
</template>

<script>
export default {
  name: "Navbar",
}
</script>

<style></style>
