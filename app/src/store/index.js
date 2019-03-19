/**
 * Vuex Store
 */

import Vue from 'vue';
import Vuex from 'vuex';

import questionsService from '@/services/questions/store'

Vue.use(Vuex);

export default new Vuex.Store({
  namespaced:true,
  modules: {
    services:{
      namespaced: true,
      modules:{
        questions: questionsService
      }
    }
  }
})
