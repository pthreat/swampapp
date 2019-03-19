import Api from '@/services/api'
import endpoints from './endpoint'

const fetch = () => {
  return Api.get(endpoints.get('fetch'));
}

export default {
 fetch
}
