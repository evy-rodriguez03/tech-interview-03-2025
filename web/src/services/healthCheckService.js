import { get } from './api/request'

async function healthCheck() {
  return get('/health')
}

export { healthCheck }
