<template>
<div class="panel panel-default">
  <div class="panel-body">
    {{ comment.text }}
  </div>
  <div class="panel-footer text-right">
    <a :href="comment.reviewUrl">{{ comment.file }}</a> line: {{ comment.line }}
  </div>
</div>
</template>

<script>
  export default {
    props: ["comment"],
  }
</script>
