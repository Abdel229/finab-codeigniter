export default class InputPreviewFiles {
  constructor(opt={}) {
    this.section = opt.section??document
    this.selector = opt.selector??'input[type="file"][data-preview-file]'
    this.primaryClassName = 'ui-preview-file'
    this.className = opt.className??''
    this.callBack = opt.callBack??null
    this.extensions = {
      image:opt.imagesExtensions??['jpg', 'jpeg', 'png', 'gif', 'svg'],
      document:opt.documentExtensions??['pdf', 'docx', 'xlsx', 'xls', 'sql', 'psd', 'vnd.ms-excel', 'vnd.openxmlformats-officedocument.spreadshee']
    }
    this.displayImage = opt.displayImage??true
    this.displayName = opt.displayName??true
    this.displaySize = opt.displaySize??true
    this.displayRemoveBtn = opt.displayRemoveBtn??true

    this.selectedImgPath = opt.selectedImgPath??null

    //===>Default css
    const STYLE = `
        .ui-file__label{height:150px;height-min:0;display: block;border: solid 1px #809198;border-radius: 4px;cursor: pointer;position: relative;}
        .ui-file__label--one .ui-file__list-item-img{width:100%;height: 100%;display:flex;align-items:center;justify-content:center;}
        .ui-file__label--one .ui-file__list-item-img>img{width:auto;height:100%;}
      `.replace(/\n/g, '').replace(/\s{2,10}\./g, '.').replace(/:\s{1,10}/g, ':')

    const existStyleBlock = document.querySelector('style[data-ui]')
    const widgetName = 'file-preview'
    if(existStyleBlock) {
      const listWidgets = existStyleBlock.getAttribute('data-ui').split(' ')
      if(listWidgets.indexOf(widgetName)===-1) {
        existStyleBlock.insertAdjacentText('beforeend', STYLE)
        listWidgets.push(widgetName)
        existStyleBlock.setAttribute('data-ui', listWidgets.join(' '))
      }
      
    } else {
      const style = document.createElement('style')
      style.setAttribute('data-ui', widgetName)
      style.innerHTML = STYLE
      document.head.appendChild(style)
    }


    const allField = this.section.querySelectorAll(this.selector)
    if(allField) {
      const className = 'ui-file'

      allField.forEach(field => {
        field.parentNode.classList.add(`${className}-wrap`)
        let label = field.nextElementSibling;

        field.addEventListener('change', e => {
          e.preventDefault()
          //const E = e
          let wFiles = e.target.files
          const files = Array.from(wFiles)
          if(files) {
            if(field.getAttribute('multiple')) {
              const filesList = document.createElement('ul')
              filesList.classList.add(`${className}-list`)
              filesList.id = `${className}-list`
              files.forEach((file, index) => {
                const fileItem = document.createElement('li')
                fileItem.classList.add(`${className}__list-item`)
                fileItem.title = file.name
                if(this.displayName)  fileItem.insertAdjacentHTML('beforeend', `<span class="${className}__list-item-name">${file.name}</span>`)
                if(this.displaySize)  fileItem.insertAdjacentHTML('beforeend', `<span class="${className}__list-item-size">${this.BytesToSize(file.size)}</span>`)
                if(this.displayRemoveBtn)  fileItem.insertAdjacentHTML('beforeend', `<button class="${className}__list-item-btn" data-action="close"><i class="icon-close"></i></button>`)
                if(this.displayImage&&file.type.match(this.extensions.image.join('.*|'))) {
                  const reader = new FileReader()
                  reader.onload = ev => {
                    fileItem.insertAdjacentHTML('afterbegin', `<span class="${className}__list-item-img"><img src="${ev.target.result}"></span>`)
                  }
                  reader.readAsDataURL(file)
                } else

                if(this.displayImage&&file.type.match(this.extensions.document.join('.*|'))) {
                  const extension = file?.name?.split('.')?.pop()
                  if(extension) {
                    const icon = `./../../../assets/images/icons/files/icon-file-${extension}.svg`
                    fileItem.insertAdjacentHTML('afterbegin', `<span class="${className}__list-item-icon"><img src="${icon}"></span>`)
                  }
                  
                }
                

                field.setAttribute('data-name', file.name)
                filesList.append(fileItem)

                const closeBtn = fileItem.querySelector('button[data-action="close"]')
                if(closeBtn) {
                  closeBtn.addEventListener('click', e => {
                    e.preventDefault()
                    files.splice(index, 1)
                    fileItem.remove()
                    wFiles = {...files}
                  })
                }

                const fieldParent = field.parentNode
                if(fieldParent) {
                  const exitUl = fieldParent.querySelector(`ul#${className}-list`)
                  if(exitUl) {
                    fieldParent.replaceChild(filesList, exitUl)
                  } else {
                    fieldParent.appendChild(filesList)
                  }
                }
              })
            } else {
              const file = files[0]
              let label = field.nextElementSibling;
              const reader = new FileReader()
              if(!label) {
                label = document.createElement('label')
                file.insertAdjacentELEMENT('beforestart', label)
              }
              label.classList.add(`${className}__label`)
              label.classList.add(`${className}__label--one`)

              reader.onload = ev => {
                label.innerHTML = `<span class="${className}__list-item-img"><img src="${ev.target.result}"></span>`
              }
              reader.readAsDataURL(file)
            }  
            
          }
        })

        if(this.selectedImgPath) {
          label.classList.add(`${className}__label`)
          label.classList.add(`${className}__label--one`)
          label.innerHTML = `<span class="${className}__list-item-img"><img src="${this.selectedImgPath}"></span>`  
        }
      })
    }
  }

  BytesToSize (bytes)  {
  const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
  if (bytes == 0) return '0 Byte'
  const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)))
  return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i]
}


}