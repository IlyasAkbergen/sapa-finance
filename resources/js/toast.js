import 'izitoast/dist/css/iziToast.min.css'
import iZtoast from 'izitoast'

const toast = {
    error: (message = "Данные не сохранены", title = 'Ошибка') => {
        return iZtoast.error({
            title: title,
            message: message,
            position: 'bottomRight',
        })
    },
    success: (message= 'Данные сохранены', title = 'Успешно') => {
        return iZtoast.success({
            title: title,
            message: message,
            position: 'bottomRight',
        })
    },
}

export default toast
