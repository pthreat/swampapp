<template>
  <div>
    <v-flex xs2>
      {{question.title}}
    </v-flex>

    <v-flex xs6>
      {{question.content}}
    </v-flex>

    <v-flex xs4>
      {{question.answer}}
    </v-flex>
  </div>
</template>

<script>
  export default {
    props:{
      question: {
        type: Object
      }
    }
  }
</script>

<style>

</style>
