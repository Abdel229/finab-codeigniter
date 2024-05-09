/*
-------------------------------
* DROPDOWN
-------------------------------
*/
export default class  Dropdown  {
  constructor(opt={}) {
    this.section = opt.section??document
    this.primaryClassName = 'ui-dropdown'
    this.className = opt.className??''
    this.idName = opt.idName??'dropdown'
    this.selector = opt.selector??`[data-dropdown="${this.idName}"]` 
    this.dropdown = null
    this.content = opt.content??''
    this.pointer = opt.pointer??true
    this.callBack = opt.callBack??null
    this.width = opt.width??'200px'
    this.fixed = opt.fixed??false
    this.autoCreate = opt.autoCreate??true

   

    //===>Default css
    const STYLE = `
      .ui-dropdown__list{list-style: none;}
      .ui-dropdown__list-item{}
      .ui-dropdown__list-item-btn,ui-dropdown__list-item-link{display: flex;flex-wrap: nowrap;width: 100%;padding: 8px 8px 8px 25px;font-size: 0.8rem;color: #8a8a8a;transition: all .3s ease-in;border-bottom: solid 1px #eee;}
      .ui-dropdown__list-item:last-child .ui-dropdown__list-item-btn,.ui-dropdown__list-item:last-child ui-dropdown__list-item-link {border:none;}
      .ui-dropdown__list-item-btn,.ui-dropdown__list-item-link{display: flex;flex-wrap: nowrap;width: 100%;padding: 8px 8px 8px 25px;font-size: 0.8rem;color: #8a8a8a;transition: all .3s ease-in;border-bottom: solid 1px #eee;}
      .ui-dropdown__list-item [class*="icon-"]{display: inline-block;-webkit-mask-size: 16px 16px;min-width: 16px;min-height: 16px;position: absolute;left: 0;top: calc(50% - 8px);background-color: #8a8a8a;}
      .ui-dropdown__list-item [class*="icon-"] {display: inline-block;-webkit-mask-size: 16px 16px;min-width: 16px;min-height: 16px;position: absolute;left: 0;top: calc(50% - 8px);background-color: #8a8a8a;}
      .ui-dropdown__list-item-btn:hover,ui-dropdown__list-item-link:hover{color: #f1902c;background-color: #fafafa;}
      .ui-dropdown__list-item-btn:hover [class*="icon-"],ui-dropdown__list-item-link:hover [class*="icon-"]{background-color: #f1902c;}
      `.replace(/\n/g, '').replace(/\s{2,10}\./g, '.').replace(/:\s{1,10}/g, ':')

    const existStyleBlock = document.querySelector('style[data-ui]')
    const widgetName = 'dropdown'
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

    //=>
    document.addEventListener('click', e => {
      const $this = e.target
      const _this = e.currentTarget
     if(!$this.hasAttribute('data-dropdown')&&(!$this.parentNode||!$this.parentNode.hasAttribute('data-dropdown'))) this.close()
    })
  }

  create(e) {
    
    const newDropdown = new Promise(resolve => {

      //===>
      const dropdown = document.createElement('div')
      dropdown.className = `${this.primaryClassName} ${this.className}`
      dropdown.id = `${this.idName}`

      //===>
      const dropdownContent = document.createElement('div')
      dropdownContent.className = `${this.primaryClassName}__content`
      const content = this.content
      if((typeof content === 'object') || content instanceof Element) {
        dropdownContent.appendChild(content)
      } else {
        dropdownContent.innerHTML = content
      }

      dropdown.appendChild(dropdownContent)
      this.dropdown = dropdown
     
      //===>
      const existDropdown = document.getElementById(this.idName)
      //console.log('existDropdown>', existDropdown)
      if(existDropdown) {
        existDropdown.innerHTML = ''
        existDropdown.parentNode.replaceChild(dropdown, existDropdown)
      } else {
        document.body.appendChild(dropdown)
        //console.log('created start', dropdown)
      }

      //==>
      dropdown.style.cssText = `
        width: ${this.width};
        position: ${(this.fixed)?'fixed':'absolute'};
        z-index: 99999;
        background-color: #fff;
        padding: 8px 8px;
        border-radius: 4px;
        box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);
      `
      this.width
      this.position(e)
      
      setTimeout(() => {
        if(this.callBack) this.callBack(dropdown)
        resolve(dropdown)
      }, 100)
       /**/
    })
  }

  close() {
    const exitDropdown = document.getElementById(this.idName)
    if(exitDropdown) {
      exitDropdown.innerHTML = ''
      exitDropdown.remove()
    }
  }

  position(e) {
    const pointerParam = {
      'x': e.pageX,
      'y': e.pageY
    }

    const dropdown = this.dropdown

    let dropdownInfos = dropdown.getBoundingClientRect()
    const windowW = window.innerWidth
    const windowH = window.innerHeight

    const pageW = windowW+window.pageXOffset
    const pageH = windowH+window.pageYOffset

    

    //=====> Btn
    const btn = e.currentTarget
    const btnInfos = btn.getBoundingClientRect()
    const btnX  = btnInfos.x+window.pageXOffset
    const btnY  = btnInfos.y+window.pageYOffset
    const btnW = btn.offsetWidth
    const btnH = btn.offsetHeight
    const btnMiddle = btnX + (btnW/2)


    //console.log('btn', btnW,  btnH, btnX, btnY, btnInfos)
    

    //==> SET SIZE
    if((dropdownInfos.width+10) > pageW) {
      dropdown.style.width = `${pageW - 10}px`
    }
    if((dropdownInfos.height+8) > pageH) {
      dropdown.style.height = `${pageH - 8}px`
    }
    dropdownInfos = dropdown.getBoundingClientRect()

    //=====> Dropdown
    const dpW = dropdownInfos.width
    const dpH = dropdownInfos.height
    let dpX = btnMiddle - (dpW/2)
    let dpY = btnY + btnH + 12
    
    const minHorizontal = 10
    const maxHorizontal = pageW - 10
    const maxVertical = pageH - 10

   //console.log('elem',btnX, (dpW/2), (dpX+dpW),  btnMiddle, dpX, minHorizontal, maxHorizontal)
   
    //==> Horizontal
    let positionHorizontal = 'left'
    if(dpX < minHorizontal) {
      dpX = minHorizontal
      positionHorizontal = 'left'
    } else
    if((dpX+dpW)>maxHorizontal) {
      dpX = pageW - maxHorizontal
      positionHorizontal = 'right'
    }
    dropdown.style[positionHorizontal] = `${dpX}px`

    
  
    //==> Vertical
    let positionVertical = 'top'
    /*if((dpY+dpH)>(maxVertical+window.pageYOffset)) {
      dpY =  maxVertical
      positionVertical = 'bottom'
    }*/
    dropdown.style[positionVertical] = `${dpY}px`

    //console.log(positionHorizontal, positionVertical, dpX)
  }
}