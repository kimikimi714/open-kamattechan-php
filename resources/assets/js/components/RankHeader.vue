<template>
<div class="media">
  <div class="media-left">
    <a :href="user.profileUrl" target="_blank">
      <img class="media-object" :src="user.imageUrl" :alt="user.name" width="128" height="128">
    </a>
  </div>
  <div class="media-body">
    <h4 class="media-heading"><a :href="user.profileUrl">{{ user.name }}</a></h4>
  </div>
</div>
</template>

<script>
  export default {
    props: ["user"],
  }
</script>
