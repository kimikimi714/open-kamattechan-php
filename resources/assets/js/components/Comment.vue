<template>
<div class="panel panel-default">
  <div class="panel-body">
    {{ comment }}
  </div>
  <div class="panel-footer text-right">
    {{ fileName }}
  </div>
</div>
</template>

<script>
  export default {
    data() {
      return {
        comment: "comment component",
        fileName: "hoge.php"
      }
    }
  }
</script>
