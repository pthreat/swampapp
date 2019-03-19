<template>
  <v-app>
    <v-toolbar color="primary" :app="true">
      <v-toolbar-title class="white--text">
        SwampApp
      </v-toolbar-title>
    </v-toolbar>

    <v-card class="mt-5 pt-3">
      <v-card-title>
        <v-text-field
          v-model="filter"
          append-icon="search"
          label="Buscar"
        />
      </v-card-title>

      <v-card-text>
        <v-list two-line subheader="">
          <v-list-tile v-for="(question, index) in filteredQuestions" :key="index">
            <v-list-tile-content>
            <v-list-tile-title>
              {{question.title}} - {{question.content}}
              <v-list-tile-sub-title>
                {{question.title}}
              </v-list-tile-sub-title>
            </v-list-tile-title>
              {{question.answer}}
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-card-text>
    </v-card>
  </v-app>
</template>

<script>

  import {mapGetters} from 'vuex'
  import escapeRegexp from 'escape-string-regexp'

  export default {
    name: 'App',
    data(){
      return {
        filter: ''
      }
    },
    computed:{
      ...mapGetters({
        questions: 'services/questions/data'
      }),
      filteredQuestions: function(){
        let me = this,
        questions = me.questions,
        filter = me.filter.trim().toLowerCase();

        if('' === me.filter){
          return questions;
        }

        filter = escapeRegexp(filter);

        return questions.filter(item =>{
          return item.content.match(filter);
        });

      }
    },
    mounted(){
      let me = this;
      me.$store.dispatch('services/questions/fetch');
    }
  }
</script>
