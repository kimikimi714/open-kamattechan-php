<template>
<div>
  <rank v-for="rank in rankings" :rank="rank"></rank>
</div>
</template>

<script>
export default {
  props: ["type", "rankings"],
}
</script>
