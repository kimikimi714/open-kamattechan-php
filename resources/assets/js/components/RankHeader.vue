<template>
<div class="media">
  <div class="media-left">
    <a :href="accountUrl" target="_blank">
      <img class="media-object" :src="imageUrl" :alt="name" width="128" height="128">
    </a>
  </div>
  <div class="media-body">
    <h class="media-heading"><a :href="accountUrl">{{ name }}</a></h4>
  </div>
</div>
</template>

<script>
  export default {
    data() {
      return {
        name: "kimikimi714",
        accountUrl: "https://github.com/kimikimi714",
        imageUrl: "/images/kimikimi714.jpeg"
      }
    }
  }
</script>
