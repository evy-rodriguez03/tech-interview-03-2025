const BASE_API_URL = 'http://localhost:8000/api' 


function configureHeaders() {
  return {}
}

function buildPayload(body) {
  if (typeof body === 'string') return body

  return JSON.stringify(body)
}

/**
 * Convierte la respuesta de Fetch a un objeto JSON.
 *
 * @param {Promise<Response} response - La respuesta del objeto Fetch.
 * @returns {Promise<Object|undefined>} - Una promesa que se resuelve en un objeto JSON o undefined si hay un error.
 */
async function toJson(response) {
  const result = await response

  const data = await result.json()

  if (result.status !== 200) throw new Error(data?.message ?? 'Error al procesar la solicitud')

  return data
}

/**
 * url: endpoint?params=&params
 */
async function request(url, method, body) {
  return fetch(`${BASE_API_URL}${url}`, { method, body: buildPayload(body), headers: configureHeaders() })
}

export async function get(url) {
  return toJson(request(url, 'GET'))
}

export async function post(url, body) {
  return toJson(request(url, 'POST', body))
}

export async function put(url, body) {
  return toJson(request(url, 'PUT', body))
}

export async function patch(url, body) {
  return toJson(request(url, 'PATCH', body))
}

export async function remove(url) {
  return toJson(request(url, 'DELETE'))
}
