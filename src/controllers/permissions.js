import Api from '@/Api'
import { usePermissionsStore } from '@/stores/permissions'
const permissionsStore = usePermissionsStore()
export default {

  getPermissions(inputs) {
    return Api.get('/permissions', {
      params: {
        page: inputs.page,
        limit: inputs.itemsPerPage
      }
    }).then(response => response.data)
  },

  getPermission(permissionId) {
    return Api.get(`/permissions/${permissionId}`).then(response => response.data)
  },

  managePermissions(inputs) {
    let permissionsRoute = inputs.item_id == null ? 'create' : 'update'
    inputs.privilege = permissionsStore.roles.length == inputs.privilege.length ? '*' : inputs.privilege.join(',')

    return Api.post(`/permissions/${permissionsRoute}`, inputs).then(response => response.data);

  },

  deletePermissions(inputs) {
    return Api.post('/permissions/delete', inputs).then(response => response.data)
  }

}
