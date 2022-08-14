// Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
// @file /Users/davidannebicque/Sites/intranetV3/assets/components/Toast.js
// @author davidannebicque
// @project intranetV3
// @lastUpdate 25/07/2022 08:38

import { Toast as ToastBs } from 'bootstrap'

class Toast {
  createAndShow(type, text, title = null, options = {}) {
    const html = `<div class="position-fixed top-0 end-0 p-3" style="z-index:1000">
      <div class="toast align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">${text}</div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close">X</button>
        </div>
      </div>
    </div>`

    const div = document.createElement('div')
    div.innerHTML = html
    div.children[0].addEventListener('hidden.bs.toast', (elem) => {
      elem.currentTarget.remove() // supprimer le code HTML après l'event.
    })
    document.body.append(div.children[0])

    this.show(type, text, title, options)
  }

  show(type, text, title = null, options = {}) {
    // options = {...this.defaultOptions, ...options}
    // todo: Utiliser le type Alerte https://gouvfr.atlassian.net/wiki/spaces/DB/pages/736362500/Alertes+-+Alerts
    // options['className'] += ' toast-' + type

    const toastElList = [].slice.call(document.querySelectorAll('.toast'))
    toastElList.map((toastEl) => {
      const tst = new ToastBs(toastEl, options)
      tst.show()
    })
  }

  error(text, title = null, options = {}) {
    this.createAndShow('danger', text, title, options)
  }

  warning(text, title = null, options = {}) {
    this.createAndShow('warning', text, title, options)
  }

  success(text, title = null, options = {}) {
    this.createAndShow('success', text, title, options)
  }

  info(text, title = null, options = {}) {
    this.createAndShow('info', text, title, options)
  }
}

export default new Toast()
