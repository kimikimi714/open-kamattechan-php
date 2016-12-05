<template>
<div>
  <div class="row">
    <div class="col-md-4">
      <h1>{{ rank.rank }}</h1>
    </div>
    <div class="col-md-8">
      <rank-header :user="rank.user"></rank-header>
      <comment :comment="rank.comment"></comment>
    </div>
  </div>
</div>
</template>

  <script>
  export default {
    props: ["rank"]
  }
  </script>
