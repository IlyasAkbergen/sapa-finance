import axios from 'axios'
import toast from './toast'
export default function setup () {
    axios.interceptors.response.use(res => {
      console.log(res)
        if(res.data.success) {
            if(res.data.message) {
                toast.success(res.data.message)
            } else {
                toast.success()
            }
        }
        else if ((res.data.props && res.data.props.errorBags) && Object.keys(res.data.props.errorBags).length > 0){
            toast.error()
        }
        return res
    }, err => {
        if(err.response.status === 401) {
          window.location.href = '/'
          return
        }
        toast.error(err.response.data.message)
        return new Promise((resolve, reject) => {
            throw err
        })
    })
}
