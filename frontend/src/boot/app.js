import { Notify } from 'quasar'

const $notify = (color, icon, message, timeout = 5000) => {
  Notify.create({
    icon,
    color,
    message,
    timeout,
    position: 'top',
    actions: [
      {
        size: 'xs',
        color: 'white',
        label: 'x',
        round: true,
        handler: () => {},
      },
    ],
  })
}

export {
  $notify,
}
