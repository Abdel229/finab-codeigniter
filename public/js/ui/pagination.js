export default class PAGINATION {
  
  constructor(opt={}) {
    this.data = opt.data??[]
    this.currentData = []
    this.limit = opt.limit??20
    this.activePage = opt.activePage??1
    this.maxPage = null
    this.callBack = opt.callBack??null

    this.targetBlock = opt.targetBlock??null
    this.idSelector = opt.idSelector??(opt.targetId??null)

    this.BLOCK = null
    this.HeaderSection = null
    this.BodySection = null
    this.BodySectionHead = null
    this.BodySectionFooter = null

    this.HEAD = opt.head??null
    this.BODY = opt.body??null
    
    this.THEAD = opt.thead??null
    this.TBODY = null

    this.theadClassList = opt.theadClassList??null
    this.tbodyClassList = opt.tbodyClassList??null

    this.theadAttrList = opt.theadAttrList??null
    this.tbodyAttrList = opt.tbodyAttrList??null

    this.navConfig = {
      top: {
        selector: (opt.navTopSelector===undefined)?'default':(opt.navTopSelector),                 // '#string' || '.string' || '[string]' || null
        position: opt.navTopPosition??'right',              // 'left' || 'center' || 'right'
        orientation: opt.navTopOrientation??'horizontal',   // 'vertical' || 'horizontal'
      },
      bottom: {
        selector: (opt.navBottomSelector===undefined)?'default':(opt.navBottomSelector),          // '#string' || '.string' || '[string]' || null
        position: opt.navBottomPosition??'right',            // 'left' || 'center' || 'right'
        orientation: opt.navBottomOrientation??'horizontal', // 'vertical' || 'horizontal'
      },
      
    }
    this.schema = opt.schema??(opt.bodyListSchema??null)
    this.theme = opt.theme??'primary' // primary || secondary || default

    this.actionsBtns = opt.actionsBtns??null

    this.primaryClassName = 'ui-pagination'
    this.className = opt.className??''

    this.emptyMsg = opt.emptyMsg??this.showMsgEmptyData()
    this.auto = opt.auto??true
    

    this.filters = {
      allow: opt.allowFilter??true,
      active: false,
      filteredData: [],
      filterSelectedKeys:null,
      selects: opt.filters??[
        {
          selector: 'status',
          label: 'Statut',
          data: [
            {
              value: -1,
              label: 'Tout',
              color: '#363740',
              selected: true
            },
            {
              value: 2,
              label: 'Actifs',
              color: '#00aa4d',
              selected: false
            },
            {
              value: 1,
              label: 'Non actifs',
              color: '#f0a61c',//#f0a61c
              selected: false
            }
          ]
        }
      ]
    }

    this.search = {
      allow: opt.allowSearch??true,
      active:false,
      key: null,
      data: []
    }


    this.sort = {
      allow: opt.allowSort??true,
      active:false,
      order:'DESC',
      key:null,
      setting: opt.sort??[]
    }


    //======> STYLE
    this.injectStyle()


    //======> START
    this.createPage().then(response => {
      if(response) {
        // Initialization current data
        this.resettingData()

        // Load current page data
        this.load_currentPageData()

        // Filters
        if(this.filters.allow&&this.filters.selects) {
          this.filtersControls.displayUi()
        }

        // Search
        if(this.search.allow)  this.searchControls

        // Sort
        if(this.sort.allow) this.sortControls

        // ActionsBtns
        if(this.actionsBtns) this.actionsBtnsControls
      }

    })
    
  }//====> End Constructor



  /**
   * 
   * @param {*} opt 
   */
  injectStyle(opt={}) {
    const additionalStyle = opt.additionalStyle??''
    const widgetName = opt.widgetName??'pagination'

    //===>Default css
    const STYLE = `
      .ui-pagination {margin-bottom: 15px;padding-top: 15px;/*display: none;*/}
      .ui-pagination.ui-pagination__theme--default{border: 5px solid #fff;border-radius: 5px;box-shadow: 0 2px 3px #ababab;background-color: #fff;padding: 15px;overflow: hidden;}
      .ui-pagination.ui-pagination__theme--primary{background-color: transparent;border:none;box-shadow:none;padding:0;}
      .ui-pagination.ui-pagination__theme--primary .ui-pagination__filters-inner {background-color: #fff;border-radius: 5px;box-shadow: 0 2px 3px #ababab;}
      .ui-pagination.ui-pagination__theme--primary .ui-pagination__body{background-color: #fff;border-radius: 5px;padding: 15px;}
      .ui-pagination__table-thead{background-color: #4e4a4b;color:#fff;}
      .ui-pagination__body {overflow-x: auto;overflow-y: hidden;}
      .ui-pagination__body::-webkit-scrollbar {width: 6px;height: 6px;}
      .ui-pagination__body::-webkit-scrollbar-thumb {width: 30%;height: 6px;background-color: #A8AAB1 !important;outline: none;border-radius: 6px;}
      .ui-pagination__body::-webkit-scrollbar-track {background-color: transparent;}
      .ui-pagination__body::-webkit-scrollbar-track-piece {width: 6px;background-color: #c6cada !important;border-radius: 5px;box-shadow: none;border: none;}
      .ui-pagination__nav-list {display: flex;align-items: center;justify-content: flex-end;padding: 10px 0 8px;}
      .ui-pagination__nav-list--left{justify-content: flex-start;}
      .ui-pagination__nav-list--center{justify-content: center;}
      .ui-pagination__nav-list--right{justify-content: flex-send;}
      .ui-pagination__nav-item {margin-left: 6px;}
      .ui-pagination__nav-item:first-child {margin-left: 0;}
      .ui-pagination__nav-item-btn {display: flex;align-items: center;justify-content: center;width: 25px;height: 25px;background-color: #36465d;/*text-align: center;line-height: 25px;*/font-size: 0.8rem;color: #fff;border-radius: 50%;transition: all .3s linear;}
      .ui-pagination__nav-item-btn:hover {color: #fff;opacity: 0.8;}
      .ui-pagination__nav-item-btn.active {background-color: #f1902c;}
      [class*="ui-pagination__nav-item-btn"]>[class*="icon-arrows-"]{background-color: #fff;min-height: 9px;}
      .ui-pagination__header{margin-bottom: 20px;z-index: 20;}
      .ui-pagination__body-head{display:flex;align-items:center;justify-content: space-between;}
      .ui-actions-btn-box__inner{display:flex;align-items:center;}
      .ui-actions-btn-btn{display:flex;align-items:center;width: 100%;background-color: #0083ec;margin-bottom: 8px;padding: 8px 14px;border-radius: 35px;color: #ffffff;box-shadow: 0 2px 3px #ababab;transition: transform .3s linear;white-space: nowrap;font-size: 0.8rem;font-family: "Exo-Semi-Bold", sans-serif;}
      .ui-actions-btn-btn:not(:last-child){margin-right:10px;}
      .ui-actions-btn-btn:hover{background-color: #2c6fa4;}
      .ui-actions-btn-btn__icon{display: inline-block;width: 18px;height: 18px;margin-right: 6px;}
      .ui-actions-btn-btn__icon>svg{fill:#c9f2ff;}
      .ui-pagination__filter-btn>*{pointer-events: none;}
      .ui-pagination__empty-msg{display: flex;justify-content: center;align-items: center;font-size: 0.8rem;color: #856404;background-color: #fff3cd;border-color: #ffeeba;padding: 20px 10px;}
      .ui-pagination__filters{margin-bottom: 5px;z-index: 20;}
      .ui-pagination__filters-inner{display: flex;color:#7a7070;background-color: #fafbfc;border-top: solid 1px #e6eff1;border-bottom: solid 1px #e6eff1;padding-bottom: 10px;/*overflow:hidden;*/z-index:5;}
      .ui-pagination__filters-footer{display:flex;justify-content:space-between;z-index:2;}
      .ui-pagination__filters-total-result{font-size: 0.7rem;color: #a3afae;}
      .ui-pagination__filters-result-actions{padding-top: 4px;}
      .ui-pagination__filters-result-actions i.icon-pdf{background-color: #268bb8;}
      .ui-pagination__filter{width: 200px;margin: 5px 8px 15px;margin-bottom: 3px;z-index:20;}
      .ui-pagination__filter-label{font-size: 0.75rem;}
      .ui-pagination__filter-box{border: solid 1px #e1e1e1;border-radius: 5px;padding: 2px 2px 2px 2px;position: relative;cursor: pointer;}
      .ui-pagination__filter-cashing-field{width: 0;height: 0;visibility: hidden;padding: 0;border: none;position: absolute;top:-100px;left:-100px;}
      .ui-pagination__filter-btn{position:relative;width:100%;height:28px;padding:8px 25px 8px 8px;display:flex;align-items:center;justify-content:flex-start;font-size: 0.75rem;}
      .ui-pagination__filter-btn::before{content: "";position: absolute;width: 16px;height: 16px;background-color: #797878;-webkit-mask-image: url(../../assets/images/svg/icon-arrow-bottom.svg);-webkit-mask-size: 16px 16px;-webkit-mask-repeat: no-repeat;-webkit-mask-position: center;right: 4px;top: calc(50% - 8px);transition: transform .3s linear;}
      .ui-pagination__filter-field{width: 0;height: 0;opacity: 0;padding: 0;border: none;position: absolute;top: -50px;}
      .ui-pagination__filter-search-field{display: flex;align-items: center;width: calc(100% - 20px);margin: 6px auto;border: solid 1px #acb8b9;height: 25px;padding: 3px 8px;color: #a8a8a8;font-size: 0.8rem;}
      .ui-pagination__filter-option{cursor: pointer;font-size: 0.8rem;height: 25px;padding: 5px 5px;}
      .ui-pagination__filter-option:hover{background-color: #cecece;}
      .ui-pagination__filter-main{position: absolute;width: 100%;max-height: 0;overflow: hidden;transition: max-height .3s linear;top: auto;left: 0;background-color: #fff;}
      .ui-pagination__filter.ui-pagination__filter--open .ui-pagination__filter-main{max-height:200px;box-shadow: 0 0 3px #0000005c;}
      .ui-pagination__filter-options-list{max-height: 150px;overflow-y: auto;}
      .ui-pagination__filter-options-list::-webkit-scrollbar{width:4px;height: 4px;}
      .ui-pagination__filter-options-list::-webkit-scrollbar-thumb{width: 30%;height: 4px;background-color: #A8AAB1 !important;outline: none;border-radius:4px;}
      .ui-pagination__filter-options-list::-webkit-scrollbar-track-piece{width: 6px;background-color: #c6cada !important;border-radius: 5px;box-shadow: none;border: none;}
      .ui-pagination__filter-item-color{display: inline-block;width: 10px;height: 10px;border-radius: 100%;background-color: #363740;margin-right: 5px;}
      .ui-pagination__filter-item-count{display: flex;margin-left: auto;font-size: 0.7rem;color: #44aaf5;}
      .ui-pagination__filter-option{display: flex;align-items: center;}
      .ui-pagination__filter-item-label{display: flex;max-width: calc(100% - 50px);display: inline-block;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
      .ui-pagination__table {width: 100%;font-size: 0.8rem;line-height: 1rem;margin-bottom: 0;border-bottom: solid 1px #ddd;}
      .ui-pagination__table>thead>tr{border-bottom: solid 1px #d7dcde;}
      .ui-pagination__table>thead>tr>th{padding: 12px 20px 12px 10px;}
      .ui-pagination__table th {padding: 8px 8px 12px 15px !important;text-align:left;}
      .ui-pagination__table th[data-sort] {cursor: pointer;}
      .ui-pagination__table th[data-sort]::before {content: "";position: absolute;display: inline-block;width: 15px;height: 15px;left: 0px;top: calc(50% - 7.5px);-webkit-mask-image: url('../../../assets/images/icons/icon-sort-default.svg');-webkit-mask-size: 15px 15px;background-position: center;-webkit-mask-repeat: no-repeat;background-color: #ababab;}
      .ui-pagination__table th[data-sort]:hover{background-color: #dbefff;}
      .ui-pagination__table th[data-sort][data-sort-order="DESC"][data-sort-selected="true"]::before {-webkit-mask-image: url('../../../assets/images/icons/icon-sort-down2.svg');}
      .ui-pagination__table th[data-sort][data-sort-order="ASC"][data-sort-selected="true"]::before {-webkit-mask-image: url('../../../assets/images/icons/icon-sort-up2.svg');}
      .ui-pagination__table th[data-sort][data-sort-selected="true"]::before {background-color: #00aa4d;}
      .ui-pagination__table tbody tr:nth-child(even) {background-color: #f9f9f9;}
      .ui-pagination__table tbody tr td {padding:8px 10px;}
      .ui-pagination__search{margin-bottom:15px;}
      .ui-pagination__search-total-result{font-size: 0.7rem;color: #a3afae;}
      .ui-pagination__search-box{max-width: 300px;border: solid 1px #d2d2d2;border-radius: 30px;padding-left:30px;overflow: hidden;}
      .ui-pagination__search-box::before{content: "";position: absolute;display: inline-block;width:16px;height:16px;left:12px;top: calc(50% - 7px);background-image: url('../../assets/images/svg/icon-search.svg');background-size: 18px auto;background-repeat: no-repeat;background-position: center;}
      .ui-pagination__search-field{width: 100%;height: 28px;font-size: 0.9rem;color: #555661;padding: 6px 6px;border: none;}
      .ui-pagination__tbl-item{overflow:hidden;padding:5px;}
      .ui-pagination__tbl-item-inner{display:flex;align-items:flex-start;flex-wrap:wrap;min-width: 280px;}
      .ui-pagination__tbl-item-img {width:80px;height:80px;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-align: center;-ms-flex-align: center;align-items: center;-webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;background-color: #fff;overflow: hidden;-webkit-box-shadow: 0px 0px 3px 0px rgb(48 44 44 / 17%);box-shadow: 0px 0px 3px 0px rgb(48 44 44 / 17%);}
      .ui-pagination__tbl-item-inner .ui-pagination__tbl-item-infos{width: calc(100% - 80px);padding:5px;}
      .ui-pagination__tbl-item-inner .ui-pagination__tbl-item-infos-row {width: calc(100% - 60px);padding: 2px;}
      .ui-pagination__tbl-item-infos-row--name{font-family: "Exo-Semi-Bold", sans-serif;font-size: 0.9rem;color: #4b4343;margin-bottom: 2px;}
      .ui-pagination__tbl-item-infos-row > .label {font-size: 0.75rem;line-height: 10px;font-family: "Exo-Semi-Bold", sans-serif;color: #6e6e6e;border-bottom: solid 1px #6e6e6e;}

      .hid-elem{display:none;}
      ${additionalStyle}
      `.replace(/\n/g, '').replace(/\s{2,10}\./g, '.').replace(/:\s{1,10}/g, ':')

    const existStyleBlock = document.querySelector('style[data-ui]')
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
  }

  /**
   * 
   * @returns 
   */
  showMsgEmptyData(opt={}) {
    const message = opt.message??'Aucun résultat trouvé !'
    return `<div class="${this.primaryClassName}__empty-msg">${message}</div>`
  }

  /**
   * 
   */
  resettingData() {
    const newResetting = JSON.parse(JSON.stringify(this.data))
    this.currentData = newResetting
    return newResetting
  }

  /**
   * 
   * @returns 
   */
  getData() {
    return JSON.parse(JSON.stringify(this.data))
  }

  /**
   * 
   * @returns 
   */
  getCurrentData() {
    return JSON.parse(JSON.stringify(this.currentData))
  }

  /**
   * 
   * @param {*} data 
   */
  setCurrentData(data) {
    this.currentData = JSON.parse(JSON.stringify(data))
  }

  /**
   * 
   * @returns 
   */
  get_currentPageData() {
    const activePage = this.activePage
    const currentData =  this.getCurrentData()
    if(currentData) {
      const start = (activePage - 1) * this.limit
      const end = start + this.limit
      const selectedData = currentData.slice(start, end)
      return selectedData
    } else {
      return []
    }
  }


  /**
   * 
   * @returns 
   */
  createPage() {
    return (async () => {
      return await new Promise((resolve, reject) => {
        const idSelector = this.idSelector
        const BLOCK = this.targetBlock??document.getElementById(idSelector)
        const currentData = this.get_currentPageData()
        const className = this.primaryClassName
        const uiName = this.primaryClassName
        const SCHEMA = this.schema

        if(BLOCK&&currentData&&SCHEMA) {
          BLOCK.setAttribute('data-section', uiName)
          BLOCK.classList.add(className)
          if(this.theme&&typeof(this.theme)==='string') BLOCK.classList.add(`${className}__theme--${this.theme}`)
          BLOCK.innerHTML = ''

          //===> BlockInner
          const BlockInner = document.createElement('div')
          BlockInner.setAttribute('data-section', `${uiName}-inner`)
          BlockInner.className = `${className}__inner`

          //===> HEADER SECTION
          const HeaderSection = document.createElement('section')
          HeaderSection.setAttribute('data-section', `${uiName}-head`)
          HeaderSection.classList = `${className}__header`
          BlockInner.appendChild(HeaderSection)

          //===> BODY SECTION
          const BodySection = document.createElement('section')
          BodySection.classList = `${className}__body`
          BodySection.setAttribute('data-section', `${uiName}-body`)
          BlockInner.appendChild(BodySection)

          //__BodySectionHead__
          const BodySectionHead = document.createElement('div')
          BodySectionHead.classList = `${className}__body-head`
          BodySectionHead.setAttribute('data-id', `${uiName}-body-head`)
          this.BodySectionHead = BodySectionHead

          //__BodySectionFooter__
          const BodySectionFooter = document.createElement('div')
          BodySectionFooter.classList = `${className}__body-footer`
          BodySectionFooter.setAttribute('data-id', `${uiName}-body-footer`)
          this.BodySectionFooter = BodySectionFooter
          
          if(this.THEAD) {
            //===> TABLE
            const TABLE = document.createElement('table')
            TABLE.classList = `${className}__table`
            TABLE.setAttribute('data-table', `${uiName}-table`)

            //===> THEAD
            if(Array.isArray(this.THEAD)) {
              const _thead = this.THEAD
              //__THEAD__
              const THEAD = document.createElement('thead')
              THEAD.classList = `${className}__table-thead ${this.tbodyClassList??''}`
              if(Array.isArray(this.theadAttr)) {
                this.theadAttr.forEach(attr => {
                  for (const [key, value] of Object.entries(attr)) {
                    THEAD.setAttribute(key, value)
                  }
                })
              }
              

              //__TR__
              const TR = document.createElement('tr')
              _thead.forEach(item => {
                const TH = document.createElement('th')
                TH.innerHTML = item.title??'' 
                if(item.width) TH.style.width = item.width                               
                TR.appendChild(TH)
              })
              this.THEAD = THEAD
              THEAD.appendChild(TR)
              //TABLE.appendChild(THEAD)
            }

            const THEAD = this.THEAD

            if((typeof THEAD === 'object') || THEAD instanceof Element) {
              TABLE.appendChild(THEAD)
            } else {
              THEAD instanceof Element ? TABLE.appendChild(THEAD) : TABLE.innerHTML =  THEAD      
            }

            this.THEAD = TABLE.querySelector('thead')
            

            //===> TBODY
            const TBODY = document.createElement('tbody')
            TBODY.setAttribute('data-tbody', `${uiName}-tbody`)
            TBODY.classList = `${this.tbodyClassList??''}`
            this.TBODY = TBODY
            if(Array.isArray(this.tbodyAttrList)) {
              this.tbodyAttrList.forEach(attr => {
                for (const [key, value] of Object.entries(attr)) {
                  TBODY.setAttribute(key, value)
                }
              })
            }
            
            /*_______====_______*/
            TABLE.appendChild(TBODY)
            BodySection.appendChild(BodySectionHead)
            BodySection.appendChild(TABLE)
            BodySection.appendChild(BodySectionFooter)
            BLOCK.appendChild(BlockInner)

            this.BLOCK = BLOCK
            this.HeaderSection = HeaderSection
            this.BodySection = BodySection

            setTimeout(() => {
              //if(this.callBack) this.callBack(BLOCK)
              resolve({BLOCK, TABLE, TBODY})
            }, 100)
          } else 
          if(this.HEAD) {
            BodySectionHead.append(this.HEAD)
          } else {
            reject('Header pagination no found')
          }
        } else {
          reject('invalid parameter')
        }
      })
    })()
  }

  /**
   * 
   */
  load_currentPageData() {
    if(this.TBODY) {
      //========> FILTER
      if(this.filters.active) this.filtersControls.doFilter()

      //========> CONTENT LIST
      const currentData = this.get_currentPageData()
      const TBODY = this.TBODY
      let ITEMS = ''
      //console.log('currentData', currentData, TBODY)
      //===>
      TBODY.innerHTML = ''
      if(currentData&&currentData.length>0) {
        currentData.forEach(item => {
          const row = this.schema(item)
          if((typeof row === 'object') || row instanceof Element) {
            TBODY.appendChild(row)
          } else {
            ITEMS += row
          }
        })
      } else {
        const totalCol = this.THEAD?this.THEAD.querySelectorAll('th').length:1
        TBODY.innerHTML = `
          <tr>
            <td colspan="${totalCol}">${this.showMsgEmptyData()}</td>
          </tr>
        `
      }

      //========> NAV
      if(this.navConfig) {
        const navConfig = this.navConfig
        const BodySectionHead = this.BodySectionHead
        const BodySectionFooter = this.BodySectionFooter
        const uiName = this.primaryClassName
        const listSection = ['top', 'bottom']
        listSection.forEach(item => {
          if(navConfig[item].selector) {
            const selector = navConfig[item].selector
            const section = (item==='top')?BodySectionHead:BodySectionFooter

            //==>
            const navItem = document.createElement('div')
            navItem.setAttribute('data-nav', item)
            navItem.classList = `${uiName}__nav ${uiName}__nav--${item}`
            const navList = this.createNav()
            if(navConfig[item].position) navList.classList.add(`${uiName}__nav-list--${navConfig[item].position}`)
            navItem.appendChild(navList)

            if(selector) {
              const existNav = (selector==='default')?section.querySelector('[data-nav]'):document.querySelector(selector)
              if(existNav) {
                existNav.parentNode.replaceChild(navItem, existNav)
              } else {
                section.appendChild(navItem)
              }
            }
          }
        })
      }

      if(this.callBack) this.callBack(this.BLOCK)
    }
  }

  /**
   * 
   * @returns 
   */
  createNav() {
    const currentData = this.getCurrentData()
    const currentDataLength = currentData.length
    const totalPage = Math.ceil(currentDataLength/this.limit)
    const activePage = this.activePage

    const className = this.primaryClassName
    const navClassName =  `${className}__nav`
    const wrap = document.createElement('ul')
    wrap.classList = `${navClassName}-list`


    //===> MAKE BTN
    const makeBtn = (opt={}) => {
      const clsName = opt.clsName??null
      let pageNum = opt.pageNum??null
      const activePageNum = this.activePage
      const type = opt.type??null // prev || next
      const prevPageNum = (activePageNum>1)?activePageNum - 1: totalPage
      const nextPageNum = (activePageNum<totalPage)?activePageNum + 1: 1

      if(type) {
        pageNum = (type==='next')? nextPageNum:prevPageNum
      }

      //__Item__
      const item = document.createElement('li')
      item.classList = `${navClassName}-item`

      //__BTN__
      const btn = document.createElement('button')
      btn.classList = `${navClassName}-item-btn ${clsName}`
      btn.setAttribute('data-page', pageNum)
      if(type) {
        btn.setAttribute('data-action', type)
        btn.innerHTML = (type==='prev')?'<i class="icon-arrows-full-left"></i>':'<i class="icon-arrows-full-right"></i>'
      } else {
        btn.textContent = pageNum
      }
      item.appendChild(btn)

      btn.addEventListener('click', e => {
        e.preventDefault()
        this.activePage =  (type)?((type==='prev')?prevPageNum:nextPageNum):pageNum
        this.load_currentPageData()
      })
      return item
    }

    //===> MAKE CURRENT NAV ITEMS
    const makeCurrentNavItems = () => {
      //==>
      const ListItems = document.createDocumentFragment()
      const activePageNum = this.activePage

      const totalElem = (totalPage<5)?totalPage:5
      if(totalPage<=totalElem) {
        for (let i= 1; i<= totalElem; i++) {
          const pageNum = i
          const clsName = (activePageNum===i)?'active':''
          ListItems.appendChild(makeBtn({clsName, pageNum}))
        }
      } else {
        const neutralLi = () => {
          const LI = document.createElement('li')
          LI.classList.add(`${navClassName}-item`)
          LI.innerHTML = '<span class="">...</span>'
          return LI
        }
        


        if(activePageNum>2)                ListItems.appendChild(makeBtn({clsName:'', pageNum:1}))
        if(activePageNum>3 )               ListItems.appendChild(neutralLi())
        if(activePageNum>1)                ListItems.appendChild(makeBtn({clsName:'', pageNum:activePageNum-1}))
        ListItems.appendChild(makeBtn({clsName:'active', pageNum:activePageNum}))
        if(activePageNum<totalPage)        ListItems.appendChild(makeBtn({clsName:'', pageNum:activePageNum+1}))
        if((activePageNum===1))            ListItems.appendChild(makeBtn({clsName:'', pageNum:3}))
        if(activePageNum<(totalPage-2))    ListItems.appendChild(neutralLi())
        if(activePageNum<totalPage-1)      ListItems.appendChild(makeBtn({clsName:'', pageNum:totalPage}))
      }
      
      return ListItems
    }

    if(currentDataLength&&currentDataLength>this.limit) {
      const prevBtn = makeBtn({type:'prev'})
      const nextBtn = makeBtn({type:'next'})

      wrap.appendChild(prevBtn)
      wrap.appendChild(makeCurrentNavItems())
      wrap.appendChild(nextBtn)
    }
    return wrap
  }

  /**
   * 
   * @param {*} option 
   * @param {*} opt 
   * @returns 
   */
  mackSelectOption(option, opt={}){
    const selector = (opt.ITEM&&opt.ITEM.selector)?opt.ITEM.selector:null
    let selectorName = null
    const className = this.primaryClassName
    const currentData = this.getData() 
    let total = currentData.length

    if(!selector) return

    if(option.value!==-1) {
      let result
      //==> SELECTOR
      const selectorSplit = selector.split('.')??[]
      if(selectorSplit.length>1) { 
        result = currentData.filter(DataRow => {
          let currentSelectorValue = null
          selectorSplit.forEach(key => {
            if(currentSelectorValue) {
              if(Array.isArray(currentSelectorValue)&&currentSelectorValue.length>0) {
                currentSelectorValue.forEach(elem => currentSelectorValue = elem[key]??null)
              } else {
                currentSelectorValue = currentSelectorValue[key]??null
              }
            } else {
              currentSelectorValue = DataRow[key]
            }
          })

          if(currentSelectorValue) {
            if(currentSelectorValue===option.value||Number(currentSelectorValue)===option.value) {
              return DataRow
            }
          }
        })
      } else {
        result =  currentData.filter(DataRow => (DataRow[selector]===option.value||Number(DataRow[selector])===option.value))
      }

      total = result.length

      //==> SELECTOR_NAME
      if(opt.ITEM.selectorName) {
        const selectorNameSplit = opt.ITEM.selectorName.split('.')??[]
        let selectorNameValue = null
        if(selectorNameSplit&&selectorNameSplit.length>1) {
          selectorNameSplit.forEach(key => {
            if(selectorNameValue) {
              if(Array.isArray(selectorNameValue)&&selectorNameValue.length>0) {
                selectorNameValue.forEach(elem => selectorNameValue = elem[key]??null)
              } else {
                selectorNameValue = selectorNameValue[key]??null
              }
            } else {
              selectorNameValue = result[0][key]
            }
          })
        } else {
          selectorNameValue = result[0][opt.ITEM.selectorName]
        }
        if(selectorNameValue) selectorName = selectorNameValue
      }
    }

    const status = (option.color)?`<span class="${className}__filter-item-color" style="background-color: ${option.color};" data-id="status"></span>`:''
    const label = (option.label)?`<span class="${className}__filter-item-label" data-id="text">${selectorName??option.label}</span>`:''
    const count = (option.label)?`<span class="${className}__filter-item-count" data-id="count">(${total??0})</span>`:''

    return `${status} ${label} ${count}`
  }

  /**
   * 
   * @param {*} data 
   * @param {*} opt 
   * @returns 
   */
  createSelectUi(ITEM, opt={}) {
    const selectId = opt.id??null
    const filterClassName = opt.className??''
    const className = this.primaryClassName
    const optionsData = ITEM.data
    const selectedOption = optionsData.find(f => f.selected===true)??optionsData[0]
    const targetSelector = opt.targetSelector??null
    const authorizationSearchField = opt.authorizationSearchField??true
    const showSearchField = authorizationSearchField&&(optionsData.length>6)
    const selectedCallBack = opt.selectedCallBack??null

    //=> WRAP
    const select = document.createElement('div')
    if(selectId) select.id = selectId
    select.setAttribute('data-filter', 'item')
    select.classList = `${className}__filter ${filterClassName}`

    //=> LABEL
    const selectLabel = document.createElement('div')
    selectLabel.classList = `${className}__filter-label`
    if(ITEM.label) {
      selectLabel.innerHTML = `<span>${ITEM.label}</span>`
      select.appendChild(selectLabel)
    }

    //=> BOX
    const selectHead = document.createElement('div')
    selectHead.classList = `${className}__filter-box`

    //=> BTN
    const button = document.createElement('button')
    button.classList = `${className}__filter-btn`
    button.setAttribute('data-fitter-btn', "selected-value")
    button.setAttribute('for', `${selectId}-field`)
    button.innerHTML = this.mackSelectOption(selectedOption, {ITEM})
    button.addEventListener('click', e => {
      e.preventDefault()
      const allOpeningOtherSelect = document.querySelectorAll(`[data-filter].${className}__filter--open`)
      if(allOpeningOtherSelect) allOpeningOtherSelect.forEach(sl => close(sl))
      open()
    })

    //=> SELECT CASH VALUE FIELD
    const cashingValueField = document.createElement('input')
    cashingValueField.classList = `${className}__filter-cashing-field`

    //=> MAIN
    const selectMain = document.createElement('div')
    selectMain.classList = `${className}__filter-main`

    //=> SEARCH FIELD
    let searchField
    if(showSearchField) {
      searchField = document.createElement('input')
      searchField.classList = `${className}__filter-search-field`
      searchField.id = `${selectId}-filter-search-field`
      searchField.addEventListener('input', e => {
        e.preventDefault()
        const currentValue = searchField.value.toLowerCase()
        const allLI = optionsList.querySelectorAll('li')
        if(allLI) {
          allLI.forEach(li => {
            const itText = li.querySelector('[data-id="text"]').textContent.toLowerCase()
            if(itText.indexOf(currentValue)>-1) {
              li.classList.remove('hid-elem')
            } else {
              li.classList.add('hid-elem')
            }
          })
        }
        
        
      })
      selectMain.appendChild(searchField)
    }
    

    //=> OPTIONS LIST WRAP
    const optionListWrap = document.createElement('div')
    optionListWrap.classList = `${className}__filter-options-list-wrap`

    //=> OPTIONS LIST
    const optionsList = document.createElement('ul')
    optionsList.classList = `${className}__filter-options-list`
    if(optionsData) {
      optionsData.forEach(item => {
        //==> OPTION
        const selectOpt = document.createElement('li')
        selectOpt.classList = `${className}__filter-option`
        selectOpt.innerHTML = this.mackSelectOption(item, {ITEM})
        optionsList.appendChild(selectOpt)

        //==>
        selectOpt.addEventListener('click', e => {
          e.preventDefault()
          optionsData.find(f => f.selected===true).selected = false
          item.selected = true
          cashingValueField.value = item.value
          button.innerHTML = this.mackSelectOption(item, {ITEM})
          if(selectedCallBack) selectedCallBack({item, options:optionsData})
          if(searchField) {
            searchField.value = ''
            const allLI = optionsList.querySelectorAll('li')
            allLI.forEach(li => li.classList.remove('hid-elem'))
          }
          close()
        })
      })
    }

    const open =  (elem=select) => elem.classList.toggle(`${className}__filter--open`)
    const close = (elem=select) => elem.classList.remove(`${className}__filter--open`)

    /*___=======____*/
    selectHead.appendChild(button)
    selectHead.appendChild(cashingValueField)
    select.appendChild(selectHead)
    if(showSearchField) selectMain.appendChild(searchField)
    optionListWrap.appendChild(optionsList)
    selectMain.appendChild(optionListWrap)
    select.appendChild(selectMain)
   
    if(targetSelector) {
      const targetBlock = ((typeof targetSelector === 'object') || targetSelector instanceof Element)? targetSelector : this.BLOCK.querySelector(targetBlock)
      if(targetBlock) targetBlock.appendChild(select)
    }

    document.body.addEventListener('click', e => {
      if(!e.target.closest('[data-filter]')&&select.classList.contains(`${className}__filter--open`)) {
        close()
      }
    })

    return select
  }

  /**
   * 
   */

  get filtersControls () {
    /**
     * select ~== ITEM
     */
    const getSelectData = ITEM => {
      let itemData = []
      if(ITEM.data==='distinct') {
        const itemDataSet = new Set()
        const selectorSplit = ITEM.selector?ITEM.selector.split('.'):null
        const DATA = this.getData()
        DATA.forEach(_item => {
          let currentSelector = null
          if(selectorSplit&&selectorSplit.length>1) {
            selectorSplit.forEach((key, index) => {
              if(currentSelector) {
                if(Array.isArray(currentSelector)&&currentSelector.length>0) {
                  currentSelector.forEach(elem => {
                    currentSelector = elem[key]??null
                  })
                } else {
                  currentSelector = currentSelector[key]??null
                }
              } else {
                currentSelector = _item[key]
              }
            })
            if(currentSelector) itemDataSet.add(currentSelector)
          } else {
            itemDataSet.add(_item[ITEM.selector])
          }
        })

        if(itemDataSet&&itemDataSet.size>0) {
          itemData.push({
            value: -1,
            label: 'Tout',
            selected: true
          })
          itemDataSet.forEach((val, key) => {
            itemData.push({
              value: key,
              label: val,
              selected: false
            })
          })
          ITEM.data = itemData
        }
        
      } else {
        itemData = ITEM.data
      }
      return itemData
    }

    /**
     * 
     * @returns 
     */
    const getSelectorKey = () => {
      const filterKeysDistinct = new Set()
      const selectsItems = this.filters.selects
      if(selectsItems&&selectsItems.length>0) {
        selectsItems.forEach(ITEM => {
          const selectData = getSelectData(ITEM)
          let selectorKey = null
          let selectedOptionValue = null
          const selector = ITEM.selector
          const selectorSplit = selector.split('.')
          const selectedOption = selectData.find(f => f.selected===true)??selectData[0]
          if(selectedOption) {
            selectedOptionValue = selectedOption.value
            if(selectorSplit&&selectorSplit.length>1) {
              selectorSplit.forEach(key => {
                if(selectorKey) {
                  if(Array.isArray(selectorKey)&&selectorKey.length>0) {
                    selectorKey =  `${selectorKey}[${key}]`
                  } else {
                    selectorKey =  `${selectorKey}.${key}`
                  }
                } else {
                  selectorKey = [key]
                }
              })
            } else {
              selectorKey = selector
            }
          } else {
            return
          }
          if(selectorKey&&selectedOptionValue) {
            filterKeysDistinct.add({
              key: selectorKey,
              value: selectedOptionValue
            })
          }
        })
      }
      return filterKeysDistinct
    }

    /**
     * select ~== ITEM
     */
    const doFilter = () => {
      const selectsItems = this.filters.selects
      let filteredData = []
      let DATA = (this.search.active)? this.getCurrentData() : this.getData()
      const allFilterKeys = getSelectorKey()
      //console.log('DATA',DATA, allFilterKeys)
      if(selectsItems&&selectsItems.length>0) {
        
        if(allFilterKeys&&allFilterKeys.size>0) {
          DATA.forEach(item => {
            let matchCount = 0
            allFilterKeys.forEach(_item => {
              const itemValue = item[_item.key]
              if(itemValue===_item.value || Number(itemValue)===_item.value || _item.value===-1) matchCount++
            })
            if(matchCount===allFilterKeys.size) filteredData.push(item)
          })
        }  
        this.filters.filterSelectedKeys = allFilterKeys   
        //console.log( allFilterKeys)
      }

      if(this.search.key) {
        filteredData = this.searchControls.search(filteredData, this.search.key)
      }

      this.setCurrentData(filteredData)
      this.filters.filteredData = filteredData
      
      //TOTAL NEW RESULT
      if(this.filters.active) {
        const blockFilterTotalResult = document.querySelector('[data-id="filters-total-result"]')
        if(blockFilterTotalResult) {
          blockFilterTotalResult.innerHTML = `
            Résultats trouvé(s) <strong>${filteredData.length} / ${DATA.length}</strong>
          `
        }
      } 
    }
    
    /**
     * 
     */
    const displayUi = () => {
      const selectsItems = this.filters.selects
      const className = this.primaryClassName
      const idSelector = this.idSelector

      if(selectsItems&&selectsItems.length>0) {
        const HeaderSection = this.HeaderSection
        if(HeaderSection) {
          //__FILTER SECTION__
          const FilterSection = document.createElement('div')
          FilterSection.setAttribute('data-id', 'filters')
          FilterSection.classList = `${className}__filters`

          //__FILTER INNER__
          const FilterInner = document.createElement('div')
          FilterInner.setAttribute('data-id', 'filters-inner')
          FilterInner.classList = `${className}__filters-inner`
          FilterSection.appendChild(FilterInner)
          HeaderSection.appendChild( FilterSection)

          //__FILTER FOOTER__
          const FilterFooter = document.createElement('div')
          FilterFooter.setAttribute('data-id', 'filters-footer')
          FilterFooter.classList = `${className}__filters-footer`
          FilterSection.appendChild(FilterFooter)

          //==> TOTAL RESULT FILTER
          const FilterResultBox = document.createElement('div')
          FilterResultBox.setAttribute('data-id', 'filters-total-result')
          FilterResultBox.classList = `${className}__filters-total-result`
          FilterFooter.appendChild(FilterResultBox)

          selectsItems.forEach(ITEM => {
            let optionsData = []
            const filterId = `${idSelector}-filter-${ITEM.selector.replace(' ', '').replace('.', '')}`
            const filterClassName = `${idSelector}__filter-${ITEM.selector.replace(' ', '').replace('.', '')}`
            optionsData = getSelectData(ITEM)
            const selectedCallBack = () => {
              if(!this.filters.active) this.filters.active = true
              const totalPage = Math.ceil(this.getCurrentData().length/this.limit)
              if(this.activePage>=totalPage) this.activePage = 1
              this.maxPage = totalPage
              this.load_currentPageData()
            }
            this.createSelectUi(ITEM, {id:filterId, className:filterClassName, data:selectsItems, targetSelector:FilterInner, selectedCallBack})
          })

        }
      }
    }


    return {
      getSelectData,
      getSelectorKey,
      doFilter,
      displayUi,
    }
  }

  /**
   * 
   */
  get searchControls () {
    const searchId = 'ui-search'

    /**
     * 
     * @param {*} data 
     * @param {*} searchKey 
     * @returns 
     */
    const search = (data, searchKey) => {
      const currentData = data
      const searchValue = searchKey.toLowerCase()
      let searchData = []
      if(searchValue.length>=1) {
        currentData.forEach(item => {
          const itemEntries = Object.entries(item)
          itemEntries.forEach((elem) => {
            let [key, value] = elem
            if(typeof value ==='string') {
              value = value.toLowerCase()
              if(value.indexOf(searchValue)>-1) {
                if(!searchData.includes(item)) searchData.push(item) 
              }
            }
          })
        })
        this.search.key = searchValue
        this.search.data = searchData
      } else {
        searchData = [...currentData]
        this.search.key = null
        this.search.data = []
      }

      return searchData
    }

    const existSearchField = document.getElementById(searchId)
    if(!existSearchField&&this.search.allow) {
      const searchClassName = `${this.primaryClassName}__search`

      //==> WRAP
      const searchSection = document.createElement('div')
      searchSection.id = searchId
      searchSection.classList = searchClassName

      //==> INNER
      const searchSectionInner = document.createElement('div')
      searchSectionInner.classList = `${searchClassName}-inner`
      searchSection.appendChild(searchSectionInner)

      //==> BOX
      const searchSectionBox = document.createElement('div')
      searchSectionBox.classList = `${searchClassName}-box`
      searchSectionBox.innerHTML = `
        <input type="search" class="${searchClassName}-field">
      `
      //===>
      const searchField = searchSectionBox.querySelector('input[type="search"]')
      if(searchField) {
        const filteredData = this.filters.filterSelectedKeys
        const currentData = (filteredData&&filteredData.length>0)? JSON.parse(JSON.stringify(filteredData)):this.getCurrentData()
        //==>
        let tbodyInitialContent = null
        let _tbody, oldValue       

        searchField.addEventListener('input', e => {
          e.preventDefault()
          const  searchKey = searchField.value
          const resultCount = searchSectionInner.querySelector('[data-id="search-result-count"]')
          const searchData = search(currentData, searchKey)
          
          if(resultCount) {
            //console.log('yes')
            if(searchKey.length>0) {
              if(resultCount) resultCount.innerHTML = `Résultats trouvé(s) <strong>${searchData.length}/${currentData.length}</strong>`
            } else {
              if(resultCount) resultCount.innerHTML = ''
            }
          }
          //console.log(searchData, currentData)
          this.setCurrentData(searchData)
          this.load_currentPageData()
        })
      }
      searchSectionInner.appendChild(searchSectionBox)
      searchSectionInner.insertAdjacentHTML('beforeend', `<span class="${searchClassName}-total-result" data-id="search-result-count"></span>`)
      if(this.BodySectionHead) this.BodySectionHead.appendChild(searchSection)
      
    }
    
    return {
      search
    }
  }

  /**
   * 
   */
  get sortControls () {

    if(this.sort.allow&&this.sort.setting&&this.sort.setting.length>0) {
      const sortData = this.sort.setting
      
      const doSort = (opt={}) => {
        const currentData = this.getCurrentData()
        
        const selector = opt.selector??null
        const order = opt.order??"DESC"
        let currentSelectorValue = null
        let selectorKey = null
        const selectorSplit = selector.split('.')
        const selectorValueIsNumber = elem  => !isNaN(Number(elem))
        const selectValueIsDate = elem => {
          if(!elem) return
          const split1 = elem.split('-')
          const split2 = elem.split(':')
          const split3 = elem.split(' ')
          return (split1&&split1.length===3&&split2&&split2.length===3&&split3&&split3.length===2)
        }
        const DataRow = currentData[0]

        if(selectorSplit&&selectorSplit.length>1) {
          selectorSplit.forEach(key => {
            if(currentSelectorValue) {
              if(Array.isArray(currentSelectorValue)&&currentSelectorValue.length>0) {
                currentSelectorValue.forEach(elem => currentSelectorValue = elem[key]??null)
                selectorKey =  `${selectorKey}[${key}]`
              } else {
                currentSelectorValue = currentSelectorValue[key]??null
                selectorKey =  `${selectorKey}.${key}`
              }
            } else {
              currentSelectorValue = DataRow[key]
              selectorKey = [key]
            }
          })
        } else {
          currentSelectorValue = DataRow[selector]
          selectorKey = selector
        }
        

        if(selectorKey) {
          //==> filter Number
          if(selectorValueIsNumber(currentSelectorValue)) {
            currentData.sort((a,b) => Number(a[selectorKey]) - Number(b[selectorKey]))
          } else
          if(selectValueIsDate(currentSelectorValue)) {
            currentData.sort((a,b) => {
              const A = new Date(a[selectorKey]).getTime()
              const B = new Date(b[selectorKey]).getTime()
              return  A - B
            })
          } else {
            currentData.sort((a,b) => {
              const A = a[selectorKey].toString().trim().toLowerCase()
              const B = b[selectorKey].toString().trim().toLowerCase()
              return A.localeCompare(B, 'fr', { ignorePunctuation: true })
            })
          }

          //console.log('currentData-1', currentData)
          
          if(order==='DESC') currentData.reverse()
          this.setCurrentData(currentData) 
          this.load_currentPageData()
                   
        }
      }

      
      const TABLE = this.BLOCK.querySelector('[data-table="ui-pagination-table"]')
      if(TABLE) {
        const _thead = TABLE.querySelector('thead')
        if(_thead) {
          const allTh = _thead.querySelectorAll('th')
          if(allTh) {
            allTh.forEach((th, index) => {
              const isSortable = sortData.find(item => item.index===index)
              if(isSortable) {
                const selector = isSortable.selector
                th.setAttribute('data-sort', selector)
                th.setAttribute('data-sort-order', "DESC")
                th.setAttribute('data-sort-selected', "false")

                th.addEventListener('click', e => {
                  e.preventDefault()
                  const currentOrder = th.getAttribute('data-sort-order')
                  const newOrder = (currentOrder==="DESC")? "ASC":"DESC"
                  allTh.forEach(_th => _th.setAttribute('data-sort-selected', "false"))
                  th.setAttribute('data-sort-order',  newOrder)
                  th.setAttribute('data-sort-selected',  "true")
                  this.sort.key = selector
                  this.sort.active = true
                  doSort({
                    selector,
                    order: newOrder
                  })
                })
              }
            })
          }
          
        }
      }
      return {
        doSort
      }
    } else {
      return
    }
  }

  /**
   * Actions
   */
  get actionsBtnsControls () {
    if(this.actionsBtns) {
      const actionsBtns = this.actionsBtns
      const actionsBtnsClassName = 'ui-actions-btn'

      const actionsBtnsBox = document.createElement('div')
      actionsBtnsBox.classList = `${actionsBtnsClassName}-box`
      const actionsBtnsBoxInner = document.createElement('div')
      actionsBtnsBoxInner.classList = `${actionsBtnsClassName}-box__inner`
      actionsBtnsBox.appendChild(actionsBtnsBoxInner)

      actionsBtns.forEach(item => {
        const btn = document.createElement('BUTTON')
        btn.classList = `${actionsBtnsClassName}-btn ${(item.className?.length>0)?item.className:''}`
        btn.innerHTML = `
          ${(item.svg?.length>0)?`<i class="${actionsBtnsClassName}-btn__icon">${item.svg}</i>`:''}
          <span class="${actionsBtnsClassName}-btn__label">${item?.label??'Action label'}</span>
        `


        if(item.callBack) {
          btn.addEventListener('click', e => {
            e.preventDefault()
            item.callBack(this.currentData)
          })
        }

        actionsBtnsBoxInner.appendChild(btn)
      })

      if(this.BodySectionHead) this.BodySectionHead.appendChild(actionsBtnsBox)
    }
  }


}//END CLASS this.sort