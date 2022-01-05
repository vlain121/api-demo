import axios from 'axios'

const uri = `/api/tasks`
export default {
    getAll(params, completion, error) {
        axios.get(uri, {
            params,
        }).then((response) => {
            completion(response.data)
        }).catch((err) => {
            if (err) {
                error(err)
            }
        })
    },
    getDetail(id, completion, error) {
        axios.get(`${uri}/detail/${id}`).then((response) => {
            completion(response.data)
        }).catch((err) => {
            if (err) {
                error(err)
            }
        })
    },
    create(form, completion, error) {
        axios.post(`${uri}/create`, form).then((response) => {
            completion(response.data)
        }).catch((err) => {
            if (err) {
                error(err)
            }
        })
    },
}
