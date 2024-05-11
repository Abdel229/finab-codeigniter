export default class MODAL {
    constructor(opt={}) {
      this.modalClassName = 'wdg-modal'
      this.modalActiveClassName = 'wdg-modal--open'
      this.btnModalCloseClassName = 'wdg-modal__btn-close'
      this.modalBackdropClassName = 'wdg-modal-backdrop'
      this.modalBackdropId = 'app-modal-backdrop'
      this.className = opt.className??''
      this.modalId = opt.id??'app-modal'
      this.modalContent = opt.modalContent?opt.modalContent:''
      this.callBack = opt.callBack??null
  
      this.modalWidth = opt.width??'680px'
      this.modalBtnClose = opt.modalBtnClose??true
  
      this.modal = null
      this.autoCreate = opt.autoCreate??true
  
      if(this.autoCreate) {
        this.modal = this.create()
        this.open()
      }
  
      //===>Default css
      const STYLE = `
        .wdg-modal{width: 0;min-height: 0;background-color:transparent;position: fixed;top: 0;left: 0;right: 0;bottom: 0;display: flex;align-items: center;justify-content: center;overflow: auto;z-index: 99999;}
        .wdg-modal::-webkit-scrollbar{width: 6px;height: 6px;}
        .wdg-modal::-webkit-scrollbar-track{background-color: transparent;}
        .wdg-modal::-webkit-scrollbar-track-piece {width: 6px;background-color: #c6cada !important; /* old #50525d*/border-radius: 5px;box-shadow: none;border: none;}
        .wdg-modal::-webkit-scrollbar-thumb {width: 30%;height: 6px;background-color: #A8AAB1 !important;outline: none;border-radius: 6px;}
        .wdg-modal__window{width:0;min-height:0;border-radius:10px;background-color: #fff;padding: 10px;transform: scale(0);transition: transform .3s linear;opacity: 0;}
        .wdg-modal--open {width: 100vw;height: 100vh;z-index: 99999;}
        .wdg-modal--open .wdg-modal__window {width: 680px;max-width: calc(100% - 20px);min-height: 0;max-height: calc(100vh - 30px);height: auto;border-radius: 0;opacity: 1;transform: scale(1);}
        .wdg-modal__btn-close {position: absolute;top: 18px;right: 18px;cursor: pointer;z-index: 10;}
        .wdg-modal__btn-close>i {background-color: #25323e;}
        .wdg-modal-backdrop {position: fixed;width: 100%;height: 100vh;background-color: rgb(13, 110, 253, 0.25);top: 0;right: 0;bottom: 0;left: 0;z-index: 999;}
        .wdg-modal__head {border-bottom: solid 1px #bdbdbd;margin-bottom: 15px;padding: 10px;z-index: 10;}
        .wdg-modal__title {font-size: 1.5rem;line-height: 1.6rem;color: #252323;font-family: "Exo-Medium", sans-serif;margin-bottom: 0px;margin-top: 0;text-align: center;}
        .wdg-modal__title  strong {font-size: 1.3rem;color: #4577d1;}
        .wdg-modal__title--without-subtitle {margin-bottom: 10px;}
        .wdg-modal__subtitle {font-size: 0.8rem;color: #a2a1a1;text-align: center;}
        .wdg-modal__body {max-height: calc(100vh - 150px);overflow: auto;}
        .wdg-modal__body::-webkit-scrollbar {width: 6px;height: 6px;}
        .wdg-modal__body::-webkit-scrollbar-track {background-color: transparent;}
        .wdg-modal__body::-webkit-scrollbar-track-piece {width: 6px;background-color: #c6cada !important; /* old #50525d*/border-radius: 5px;box-shadow: none;border: none;}
        .wdg-modal__body::-webkit-scrollbar-thumb {width: 30%;height: 6px;background-color: #A8AAB1 !important;outline: none;border-radius: 6px;}
        .wdg-modal--alert textarea.cpn-field{min-height:90px;border: 1px solid #959595 !important;}
        @media(max-width: 960px) {.wdg-modal__body {padding: 20px 25px;}}
        @media(max-width: 767px) {.wdg-modal__body {padding: 15px 15px;}}
        @media(max-width: 640px) {.wdg-modal__body {padding: 15px 10px;}}
      `.replace(/\n/g, '').replace(/\s{2,10}\./g, '.').replace(/:\s{1,10}/g, ':')
  
      const existStyleBlock = document.querySelector('style[data-widgets]')
      const widgetName = 'modal'
      if(existStyleBlock) {
        const listWidgets = existStyleBlock.getAttribute('data-widgets').split(' ')
        if(listWidgets.indexOf(widgetName)===-1) {
          existStyleBlock.insertAdjacentText('beforeend', STYLE)
          listWidgets.push(widgetName)
          existStyleBlock.setAttribute('data-widgets', listWidgets.join(' '))
        }
        
      } else {
        const style = document.createElement('style')
        style.setAttribute('data-widgets', widgetName)
        style.innerHTML = STYLE
        document.head.appendChild(style)
      }
    }
  
  
    create() {
      const constructor = async () => {
        const newModal =  await new Promise((resolve) => {
          //=>
          const modal = document.createElement('div')
          modal.setAttribute('data-wdg-id', 'modal')
          modal.id = `${this.modalId}`
          modal.className = `${this.modalClassName} ${this.className}`
  
          //=>
          const modalWindow = document.createElement('div')
          modalWindow.className = `${this.modalClassName}__window ${this.modalClassName}__inner`
          if(this.modalBtnClose) modalWindow.innerHTML = `<button class="${this.btnModalCloseClassName}" data-modal-close="true"><i class="${this.btnModalCloseClassName}-icon icon-close"></i></button>`
          if(this.modalWidth) modalWindow.style.width = this.modalWidth
  
          //=> 
          const modalMain = document.createElement('div')
          const modalContent = this.modalContent
          if(modalContent) {
            modalMain.className = `${this.modalClassName}__content`
            modalMain.setAttribute('data-model-section', 'content')
            if(typeof modalContent === 'object') {
              modalMain.appendChild(modalContent)
            } else {
              modalContent instanceof Element ?  modalMain.appendChild(modalContent) : modalMain.innerHTML =  modalContent
            }
            
          }
          modalWindow.appendChild(modalMain)
  
          if(modalWindow) modal.appendChild(modalWindow)
  
          const existModal = document.getElementById(this.modalId)
          if(existModal) {
            existModal.innerHTML = ''
            existModal.parentNode.replaceChild(modal, existModal)
          } else {
            document.body.appendChild(modal)
          }
  
          setTimeout(() => {
            if(this.callBack) this.callBack(modal)
            resolve(modal)
          }, 100)
        })
  
        return newModal
      }
  
      return constructor()
    }
  
    open(modalTarget=this.modal) {
      if(modalTarget) {
        modalTarget.then(modal => {
          const existModalBackdrop = document.getElementById(this.modalBackdropId)
          if(!existModalBackdrop) {
            const modalBackdrop = document.createElement('div')
            modalBackdrop.className = this.modalBackdropClassName
            modalBackdrop.id = this.modalBackdropId
            document.body.append(modalBackdrop)
          }
          modal.classList.add(this.modalActiveClassName)
          modal.setAttribute('data-modal-state', 'open')
          this.defaultClose()
        })
      } else {
        console.log('Error: No found Modal Target')
      }
    }
  
    close(modalTarget=this.modal) {
      if(modalTarget) {
        const modalBackdrop = document.getElementById(`${this.modalBackdropId}`)
        modalTarget.then(modal => {
          modal.setAttribute('data-modal-state', 'close')
          modal.parentNode.removeChild(modal)
          const existOtherOpenModal = document.querySelectorAll(`.${this.modalActiveClassName}`)
          if(modalBackdrop && (!existOtherOpenModal || (existOtherOpenModal&&existOtherOpenModal.length===0))) {
            modalBackdrop.remove()
          }
        })
        
      } else {
        console.log('Error: No found Modal Target')
      }
    }
  
    defaultClose(modalTarget=this.modal) {
      if(modalTarget) {
        modalTarget.then(modal => {
          //=> Close modal when click on btn with attribute data-modal-close="true"
          const closeBtn = modal.querySelectorAll('[data-modal-close="true"]')
          if(closeBtn) {
            closeBtn.forEach(btn => {
              btn.addEventListener('click', e => {
                e.preventDefault()
                const $this = e.target
                //const currentModal = $this.closest(`.${this.modalPrimaryClassName}`)
                this.close()
              })
            })
          }
  
          //=> Close modal when click on body
          document.addEventListener('click', e => {
            const $this = e.target
            if ($this===modal) {
              this.close()
            }
          })
        })
        
      } else {
        console.log('Error: No found Modal Target')
      }
    }
  }