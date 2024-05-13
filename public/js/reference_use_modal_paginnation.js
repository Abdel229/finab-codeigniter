if (subsidiaryProducts) {
    const thead = [
        { title: "Produits", }, { title: "Prix", }, { title: "Stocks", }, { title: "", },];

    const schema = (item) => {
        const productId = Number(item.product_id);
        const subsidiaryProductId = Number(item.id);
        const productStatus = Number(item.status);
        const imgName = item?.image?.length > 0 ? item.image : "default.png";
        const category = item.category ?? null;
        const originalBarcode = item.original_barcode;

        const config = JSON.parse(item.config);
        //console.log("config", config);

        let productStatusColor = "";
        switch (productStatus) {
            case 1:
                productStatusColor = "warning";
                break;
            case 2:
                productStatusColor = "success";
                break;
            case 0:
                productStatusColor = "danger";
                break;
        }

        const stock = Number(item.stock);
        const alertStock = Number(item.qty_stock_alert);
        const qtyInCardBox = Number(item.qty_in_cardboard);
        const totalCardBox =
            qtyInCardBox > 0 ? Math.floor(stock / qtyInCardBox) : 0;
        const stockRestOuputCardbox =
            qtyInCardBox > 0 ? stock % qtyInCardBox : 0;
        const stockShow =
            totalCardBox > 0
                ? `${formatFigures(totalCardBox)} <small>Carton${totalCardBox > 1 ? "s" : ""
                }</small> ${stockRestOuputCardbox > 0
                    ? ` et ${formatFigures(
                        stockRestOuputCardbox
                    )} <small>bouteille${stockRestOuputCardbox > 1 ? "s" : ""
                    }</small>`
                    : ""
                }`
                : `${formatFigures(stock)}<small> bouteille${stock > 1 ? "s" : ""
                }</small>`;

        const TotalStock = `${formatFigures(stock)} ${wordPlural({
            single: "bouteille",
            qty: stock,
        })}`;
        const TolatAlertStock = `${formatFigures(alertStock)} ${wordPlural({
            single: "bouteille",
            qty: alertStock,
        })}`;

        const schema = document.createDocumentFragment();
        const TR = document.createElement("tr");
        TR.innerHTML = `
 <td>
 <div class="ui-pagination__tbl-item">
 <div class="ui-pagination__tbl-item-inner">
 <div class="ui-pagination__tbl-item-img">
 <img src="${baseUrl}assets/images/upload/products/${imgName}">
 </div>
 <div class="ui-pagination__tbl-item-infos">
 <div class="ui-pagination__tbl-item-infos-row ui-pagination__tbl-item-infos-row--name">
 ${statusUI({
            type: "round",
            status: productStatusColor,
        })}
 ${item.name}
 </div>
 ${category?.name
                ? `
 <div class="ui-pagination__tbl-item-infos-row">
 <span class="label">Catégorie:</span>
 <span class="value">${category.name}</span>
 </div>
 `
                : ""
            }
 <div class="ui-pagination__tbl-item-infos-row">
 <span class="label">Qté en carton:</span>
 <span class="value">${item.qty_in_cardboard}</span>
 </div>
 <div class="ui-pagination__tbl-item-infos-row">
 <span class="label">ID Produit:</span>
 <span class="value">${item.product_id}</span>
 </div>
 <div class="ui-pagination__tbl-item-infos-row">
 <span class="label">ID Filiale-Produit:</span>
 <span class="value">${item.id}</span>
 </div>
 </div>
 </div>
 </div>
 </td>
 <td>
 <div class="ui-pagination__tbl-item-infos">
 <div class="ui-pagination__tbl-item-infos-row">
 <span class="label">D'achat:</span>
 <span class="value">${formatter.format(
                item.buying_price
            )}</span>
 </div>
 <div class="ui-pagination__tbl-item-infos-row">
 <span class="label">De vente:</span>
 <span class="value">${formatter.format(
                item.selling_price
            )}</span>
 </div>
 </div>
 </td>
 
 <td>
 <div class="ui-pagination__tbl-item-infos">
 <div class="ui-pagination__tbl-item-infos-row">
 <span class="label">Diponible:</span>
 <span class="value">${stockShow}</span>
 </div>
 <div class="ui-pagination__tbl-item-infos-row">
 <span class="label">Total:</span>
 <span class="value">${TotalStock}</span>
 </div>
 <div class="ui-pagination__tbl-item-infos-row">
 <span class="label">Alert:</span>
 <span class="value">${TolatAlertStock}</span>
 </div>
 </div>
 </td>
 <td>
 <div class="cpn-table__actions-btns">
 <button class="menu-code-btn" data-dropdown="product-menu-actions" data-action="open-product-menu"><i class="icon-menu-actions-vertical"></i></button>
 </div> 
 </td>
 `;

        //=>> CATEGORIES DATA
        const activesCategories = prodoctsCategories.filter(
            (cat) => Number(cat.status) === 2
        );

        const menuBtn = TR.querySelector(
            'button[data-action="open-product-menu"]'
        );
        if (menuBtn) {
            const productMenuContent = `
 <ul class="ui-dropdown__list">
 ${productStatus === 1
                    ? `
 <li class="ui-dropdown__list-item">
 <button class="ui-dropdown__list-item-btn" data-action="activate">
 <i class="icon-activate"></i>
 Activer
 </button>
 </li>
 `
                    : ""
                }
 ${productStatus === 2
                    ? `
 <li class="ui-dropdown__list-item">
 <button class="ui-dropdown__list-item-btn" data-action="disabled">
 <i class="icon-disabled"></i>
 Désactiver
 </button>
 </li>
 `
                    : ""
                }
 <li class="ui-dropdown__list-item">
 <button class="ui-dropdown__list-item-btn" data-action="edit">
 <i class="icon-edit"></i>
 Modifier
 </button>
 </li>
 <li class="ui-dropdown__list-item">
 <button class="ui-dropdown__list-item-btn" data-action="barcode-control">
 <i class="icon-barcode"></i>
 Code bar
 </button>
 </li>
 <li class="ui-dropdown__list-item">
 <button class="ui-dropdown__list-item-btn" data-action="change-stock">
 <i class="icon-plus-minus"></i>
 Ajuster le stock
 </button>
 </li>
 </ul>
 `;
            const dropdown = new Dropdown({
                autoCreate: false,
                content: productMenuContent,
                idName: "product-menu--click",
                callBack: (dropdown) => {
                    //===> Change Status
                    ["disabled", "activate"].forEach((attr) => {
                        const changeStatusBtn = dropdown.querySelector(
                            `button[data-action="${attr}"]`
                        );
                        if (changeStatusBtn) {
                            changeStatusBtn.addEventListener("click", (e) => {
                                e.preventDefault();
                                const settingVal = {
                                    title: `Changement de statut de produit`,
                                    action: attr === "disabled" ? "désactiver" : "activer",
                                    color: attr === "disabled" ? "#ff1212" : "#094529",
                                    newStatus: attr === "disabled" ? 1 : 2,
                                };

                                AlertModal({
                                    title: settingVal.title,
                                    alertMessage: `Vous Êtes sur le point de vouloir <mark style="color:${settingVal.color};">${settingVal.action}</mark> le produit <mark class="cpn-alert-change-status__text--mark">${item.name}</mark>`,
                                    className: "warning",
                                    description: true,
                                    callBack: (response) => {
                                        const {
                                            data,
                                            emptyKeys,
                                            fields,
                                            showFormError,
                                            successFormSubmit,
                                        } = response;
                                        if (data.description) {
                                            const description = data.description;

                                            if (description.length >= 5) {
                                                const formData = new FormData();
                                                formData.append("userId", userId);
                                                formData.append("cause", description);
                                                formData.append("doBy", "users");
                                                formData.append(
                                                    "dataItem",
                                                    JSON.stringify({
                                                        status: settingVal.newStatus,
                                                    })
                                                );
                                                AppFetch(
                                                    `${baseUrl}api/products/update/${subsidiaryProductId}`,
                                                    {
                                                        method: "POST",
                                                        body: formData,
                                                    }
                                                ).then((responseUpdateProduct) => {
                                                    if (
                                                        responseUpdateProduct?.status === "success"
                                                    ) {
                                                        console.log(
                                                            "responseUpdateProduct",
                                                            responseUpdateProduct
                                                        );
                                                        successFormSubmit({ refresh: true });
                                                    } else {
                                                        showFormError(
                                                            `Désolé, La modifiaction a échouée!`
                                                        );
                                                    }
                                                });
                                            } else {
                                                showFormError("Motif trop court!");
                                            }
                                        } else {
                                            showFormError("Veuillez renseigner le motif.");
                                        }

                                        // const submitCallBack = arg => {
                                        // const {data, showFormError, emptyKeys, successFormSubmit} = arg
                                        // console.log('data', data, userId)
                                        // }
                                    },
                                });
                            });
                        }
                    });

                    //===> Edit Product
                    const editProduct = dropdown.querySelector(
                        'button[data-action="edit"]'
                    );
                    if (editProduct) {
                        const modalContent = () => {
                            const modalContent = document.createDocumentFragment();
                            const className = "modal-add-new-prod";
                            const formId = "edit-product-form";
                            const modalInner = document.createElement("div");
                            modalInner.classList = className;
                            modalInner.innerHTML = `
 <div class="ui-modal__head">
 <h2 class="ui-modal__title">Modification de produit</h2>
 </div>
 <div class="ui-modal__body">
 <form method="post" class="cpn-form" id="${formId}" enctype="multipart/form-data">
 <div class="cpn-form__row">
 <input type="file" class="cpn-field" name="file" id="productImgFiledEdit" data-preview-file="true" accept="image/*" required>
 <label for="productImgFiledEdit" class="cpn-form__label"></label>
 </div>
 <div class="cpn-form__row">
 <label for="categoryIdFieldEdit" class="cpn-form__label">Choisir une catégorie</label>
 <select name="categoryId" id="categoryIdFieldEdit" required></select>
 </div>
 <div class="cpn-form__row">
 <label for="productNameFiledEdit" class="cpn-form__label">Nom du produit</label>
 <input type="text" name="productName" id="productNameFiledEdit" value="${item.name}" required>
 </div>
 <div class="ui-x">
 <div class="cpn-form__row ui-x__2elem">
 <label for="buyingPriceFiledEdit" class="cpn-form__label">Prix d'achat (en frCFA)</label>
 <input type="number" name="buyingPrice" id="buyingPriceFiledEdit" value="${item.buying_price}" required>
 </div>
 <div class="cpn-form__row ui-x__2elem">
 <label for="sellingingPriceFiledEdit" class="cpn-form__label">Prix de vente (en frCFA)</label>
 <input type="number" name="sellingingPrice" id="sellingingPriceFiledEdit" value="${item.selling_price}" required>
 </div>
 </div>
 <div class="ui-x">
 <div class="cpn-form__row ui-x__2elem">
 <label for="qtyInCardboardFiledEdit" class="cpn-form__label">Nombre d'unité en carton</label>
 <input type="number" name="qtyInCardboard" id="qtyInCardboardFiledEdit" value="${item.qty_in_cardboard}" required>
 </div>
 <div class="cpn-form__row ui-x__2elem">
 <label for="qytStockAlertFiledEdit" class="cpn-form__label">Stock Alert</label>
 <input type="number" name="qytStockAlert" id="qytStockAlertFiledEdit" value="${item.qty_stock_alert}" required>
 </div>
 </div>
 <div class="cpn-form__bottom">
 <button class="cpn-btn cpn-form__btn" data-action="cancel">Annuler</button>
 <button class="cpn-btn cpn-form__btn" name="submit" data-action="submit">Modifier</button>
 </div>
 </form>
 </div>
 `;
                            const form = modalInner.querySelector(`form#${formId}`);
                            if (form) {
                                const btn = form.querySelector(
                                    'button[data-action="submit"]'
                                );
                                if (!btn) return;

                                //==>>>
                                const categoryIdField = form.querySelector(
                                    `select#categoryIdFieldEdit`
                                );
                                if (prodoctsCategories && categoryIdField) {
                                    const categoryId = item.products_category_id;
                                    categoryIdField.innerHTML = selectOptions({
                                        data: prodoctsCategories.sort((a, b) =>
                                            a.name.localeCompare(b.name)
                                        ),
                                        selectedList: [categoryId],
                                    });
                                }

                                //==>>>
                                new InputPreviewFiles({
                                    section: form,
                                    selectedImgPath: `${baseUrl}assets/images/upload/products/${imgName}`,
                                });

                                //===>>> SEND FORM
                                const submitCallBack = (arg) => {
                                    const {
                                        data,
                                        showFormError,
                                        emptyKeys,
                                        successFormSubmit,
                                    } = arg;
                                    if (emptyKeys?.length > 0) {
                                        showFormError(
                                            "Désolé, veuillez renseigner les champs obligatoires."
                                        );
                                    } else {
                                        const formData = new FormData();
                                        formData.append("userId", userId);
                                        if (data?.file?.name) {
                                            formData.append("image", data.file);
                                        }
                                        formData.append(
                                            "dataItem",
                                            JSON.stringify({
                                                products_category_id: data.categoryId,
                                                name: data.productName,
                                                buying_price: data.buyingPrice,
                                                selling_price: data.sellingingPrice,
                                                qty_in_cardboard: data.qtyInCardboard,
                                                qty_stock_alert: data.qytStockAlert,
                                            })
                                        );
                                        AppFetch(
                                            `${baseUrl}_api/products/update/${subsidiaryProductId}`,
                                            {
                                                method: "POST",
                                                body: formData,
                                            }
                                        ).then((responseUpdateProduct) => {
                                            if (responseUpdateProduct?.status === "success") {
                                                successFormSubmit({ refresh: true });
                                            } else {
                                                showFormError(
                                                    responseUpdateProduct?.message ??
                                                    `Désolé, La modifiaction a échouée!`
                                                );
                                            }
                                        });
                                    }
                                };
                                FormControlSubmit({ form, btn, submitCallBack });
                            }
                            modalContent.appendChild(modalInner);
                            return modalContent;
                        };

                        editProduct.addEventListener("click", (e) => {
                            e.preventDefault();
                            const modal = new MODAL({
                                id: "modalNewProduct",
                                className: "wdg-modal--default",
                                modalContent: modalContent(),
                                width: "500px",
                            });
                        });
                    }

                    //===> Barcode control
                    const barcodeControlBtn = dropdown.querySelector(
                        'button[data-action="barcode-control"]'
                    );
                    if (barcodeControlBtn) {
                        let modal;
                        const modalContent = () => {
                            const modalContent = document.createDocumentFragment();
                            const className = "modal-barcode-control";
                            const printBarcodeformId = "print-barcode-form";
                            const originalBarcodeformId = "original-barcode-form";
                            const modalInner = document.createElement("div");
                            modalInner.classList = className;
                            modalInner.innerHTML = `
 <div class="ui-modal__head">
 <h2 class="ui-modal__title">Contrôle code bar</h2>
 <div class="ui-modal__subtitle"><strong>Produit: </strong> ${item.name
                                }</div>
 </div>
 <div class="ui-modal__body">
 <div class="cpn-tas" data-tabs="barcode-control">
 <ul class="cpn-tas__nav">
 <li class="cpn-tas__nav-item">
 <button class="cpn-tas__nav-item-btn selected" data-tabs-target="1">Impression</button>
 </li>
 <li class="cpn-tas__nav-item">
 <button class="cpn-tas__nav-item-btn" data-tabs-target="2">Code bar original</button>
 </li>
 <li class="cpn-tas__nav-item">
 <button class="cpn-tas__nav-item-btn" data-tabs-target="3">Configuration</button>
 </li>
 </ul>
 <div class="cpn-tas__body">
 <div class="cpn-tas__body-item selected" data-tabs-box-name="1">
 <form class="cpn-form" id="${printBarcodeformId}">
 <div class="cpn-form__row">
 <label for="typeBarcode" class="cpn-form__label">Type de code bar à considérer <span class="cpn-form__label-required">*</span></label>
 <select name="typeBarcode" class="cpn-field" id="typeBarcode" required>
 <option value="original">Original</option>
 <option value="custom" selected>Personalisé</option>
 </select>
 </div>
 <div class="cpn-form__row">
 <label for="printQtyFiledEdit" class="cpn-form__label">Quantité à imprimer <span class="cpn-form__label-required">*</span></label>
 <input type="number" name="printQty" id="printQtyFiledEdit" value="10" required/>
 </div>
 <div class="cpn-form__bottom">
 <button class="cpn-btn cpn-form__btn" name="submit" data-action="submit">Imprimer</button>
 </div>
 </form>
 </div>
 <div class="cpn-tas__body-item" data-tabs-box-name="2">
 ${originalBarcode?.length > 0
                                    ? `
 <div class="barcode-original">
 <svg id="svg-barcode-original"></svg>
 </div>
 `
                                    : `
 <form class="cpn-form" id="${originalBarcodeformId}">
 <div class="cpn-form__row">
 <label for="barcodeFiledEdit" class="cpn-form__label">Scanner le code bar <span class="cpn-form__label-required">*</span></label>
 <input type="number" name="barcode" id="barcodeFiledEdit" required/>
 </div>
 <div class="cpn-form__bottom">
 <button class="cpn-btn cpn-form__btn" name="submit" data-action="submit">Ajouter</button>
 </div>
 </form>
 `
                                }
 
 </div>
 <div class="cpn-tas__body-item" data-tabs-box-name="3">
 <div class="barcode-config-box">
 <div class="barcode-config-box__row">
 <h5 class="barcode-config-box__title">Code bar à utilisé à la caisse:</h5>
 <div class="cpn-form__row">
 <input type="radio" class="cpn-field" id="customBarcodeSelectField" ${config?.barcodeForSale === "custom"
                                    ? "checked"
                                    : ""
                                } name="activeBarCode" value="custom"/>
 <label class="cpn-form__label" for="customBarcodeSelectField">Personnalisé:</label>
 </div>
 <div class="cpn-form__row">
 <input type="radio" class="cpn-field" id="originalBarcodeSelectField" ${config?.barcodeForSale === "original"
                                    ? "checked"
                                    : ""
                                } name="activeBarCode" value="original"/>
 <label class="cpn-form__label" for="originalBarcodeSelectField">Original:</label>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 </div>
 `;
                            //==>> ControlTabs
                            ControlTabs({ selector: modalInner });

                            //==>> PrintBarcodeform
                            const printBarcodeform = modalInner.querySelector(
                                `form#${printBarcodeformId}`
                            );
                            if (printBarcodeform) {
                                const form = printBarcodeform;
                                const btn = form.querySelector(
                                    'button[data-action="submit"]'
                                );
                                if (!btn) return;

                                const submitCallBack = async (arg) => {
                                    const {
                                        data,
                                        showFormError,
                                        emptyKeys,
                                        successFormSubmit,
                                    } = arg;
                                    if (emptyKeys?.length > 0) {
                                        showFormError(
                                            "Désolé, veuillez renseigner les champs obligatoires."
                                        );
                                    } else {
                                        const formData = new FormData();
                                        formData.append("userId", userId);
                                        formData.append("subsidiaryId", subsidiaryId);
                                        formData.append("type", data.typeBarcode);
                                        formData.append("qty", data.printQty);
                                        const getBarcodeResponse = await AppFetch(
                                            `${baseUrl}_api/products/getBarcode/${productId}`,
                                            {
                                                method: "POST",
                                                body: formData,
                                            }
                                        );

                                        if (getBarcodeResponse?.status === "success") {
                                            const BARCODE = getBarcodeResponse.data.barcode;
                                            const styles = `
 .print-list-barcode{width:100%;margin:auto;}
 `;
                                            let list = "";
                                            for (
                                                let index = 0;
                                                index < data.printQty;
                                                index++
                                            ) {
                                                list += '<svg data-id="barcode"></svg>';
                                            }
                                            const body = `<div class="print-list-barcode" id="print-list-barcode">${list}</div>`;
                                            modal.close();
                                            WindowPrinter({
                                                styles,
                                                body,
                                                width: "100%",
                                                isInvoice: false,
                                                callBack: (ifrDoc) => {
                                                    const barcodeBlocks = ifrDoc.querySelectorAll(
                                                        '[data-id="barcode"]'
                                                    );
                                                    if (barcodeBlocks) {
                                                        barcodeBlocks.forEach((barcodeBlock) => {
                                                            JsBarcode(barcodeBlock, BARCODE, {
                                                                format: "CODE128",
                                                                width: 5,
                                                            });
                                                        });
                                                    }
                                                },
                                            });
                                        } else {
                                            showFormError(
                                                getBarcodeResponse?.message ??
                                                `Désolé, La modifiaction a échouée!`
                                            );
                                        }
                                    }
                                };
                                FormControlSubmit({ form, btn, submitCallBack });
                            }

                            //==>> AddNewOriginalBarcodeform
                            const originalBarcodeform = modalInner.querySelector(
                                `form#${originalBarcodeformId}`
                            );
                            if (originalBarcodeform) {
                                const form = originalBarcodeform;
                                const btn = form.querySelector(
                                    'button[data-action="submit"]'
                                );
                                if (!btn) return;

                                const submitCallBack = async (arg) => {
                                    const {
                                        data,
                                        showFormError,
                                        emptyKeys,
                                        successFormSubmit,
                                    } = arg;
                                    if (emptyKeys?.length > 0) {
                                        showFormError(
                                            "Désolé, veuillez renseigner les champs obligatoires."
                                        );
                                    } else {
                                        const formData = new FormData();
                                        formData.append("userId", userId);
                                        formData.append(
                                            "cause",
                                            "Enregistrement du code bar original"
                                        );
                                        formData.append("doBy", "users");
                                        formData.append(
                                            "dataItem",
                                            JSON.stringify({
                                                original_barcode: data.barcode,
                                            })
                                        );
                                        AppFetch(
                                            `${baseUrl}api/products/update/${subsidiaryProductId}`,
                                            {
                                                method: "POST",
                                                body: formData,
                                            }
                                        ).then((responseUpdateProduct) => {
                                            if (responseUpdateProduct?.status === "success") {
                                                console.log(
                                                    "responseUpdateProduct",
                                                    responseUpdateProduct
                                                );
                                                successFormSubmit({ refresh: true });
                                            } else {
                                                showFormError(
                                                    responseUpdateProduct?.message ??
                                                    `Désolé, La modifiaction a échouée!`
                                                );
                                            }
                                        });
                                    }
                                };
                                FormControlSubmit({ form, btn, submitCallBack });
                            } else {
                                const barCodeOriginalSvg = modalInner.querySelector(
                                    "svg#svg-barcode-original"
                                );
                                if (barCodeOriginalSvg && originalBarcode?.length > 0) {
                                    JsBarcode(barCodeOriginalSvg, originalBarcode);
                                }
                            }

                            //==>>
                            const allCheckboxFieldBarcode = modalInner.querySelectorAll(
                                'input[type="radio"][name="activeBarCode"]'
                            );
                            if (allCheckboxFieldBarcode && config?.barcodeForSale) {
                                allCheckboxFieldBarcode.forEach((field) => {
                                    field.addEventListener("change", (e) => {
                                        e.preventDefault();
                                        const value = field.value;
                                        config.barcodeForSale = value;

                                        const formData = new FormData();
                                        formData.append("userId", userId);
                                        formData.append(
                                            "cause",
                                            "Changement de type de code bar"
                                        );
                                        formData.append("doBy", "users");
                                        formData.append(
                                            "dataItem",
                                            JSON.stringify({
                                                config: JSON.stringify(config),
                                            })
                                        );
                                        AppFetch(
                                            `${baseUrl}api/products/update/${subsidiaryProductId}`,
                                            {
                                                method: "POST",
                                                body: formData,
                                            }
                                        ).then((responseUpdateTypeBarcode) => {
                                            if (
                                                responseUpdateTypeBarcode?.status === "success"
                                            ) {
                                                AlertMessage({
                                                    message: "Success!!!",
                                                    type: "success",
                                                });
                                                console.log("change success");
                                                //successFormSubmit({refresh:true})
                                            } else {
                                                showFormError(
                                                    responseUpdateTypeBarcode?.message ??
                                                    `Désolé, La modifiaction a échouée!`
                                                );
                                            }
                                        });

                                        // console.log('change')
                                    });
                                });
                            }
                            modalContent.appendChild(modalInner);
                            return modalContent;
                        };

                        barcodeControlBtn.addEventListener("click", (e) => {
                            e.preventDefault();
                            modal = new MODAL({
                                id: "modalBarCodeControl",
                                className: "wdg-modal--default",
                                modalContent: modalContent(),
                                width: "500px",
                            });
                        });
                    }

                    //===> Change Qty Stock
                    const btnChangeStockBtn = dropdown.querySelector('button[data-action="change-stock"]')
                    if (btnChangeStockBtn) {
                        const modalContent = () => {
                            const modalContent = document.createDocumentFragment()
                            const className = "modal-change-qty-stock-prod"
                            const formId = "change-qty-stock-product-form"
                            const modalInner = document.createElement("div")
                            modalInner.classList = className
                            modalInner.innerHTML = `
 <div class="ui-modal__head">
 <h2 class="ui-modal__title">Modification du stock du produit:</h2>
 <div class="ui-modal__subtitle"><strong>Produit: </strong> ${item.name}</div>
 </div>
 <div class="ui-modal__body">
 <form method="post" class="cpn-form" id="${formId}" enctype="multipart/form-data">
 
 <div class="cpn-form__row">
 <input type="radio" name="action" id="addQtyFiledEdit" value="add">
 <label for="addQtyFiledEdit" class="cpn-form__label">Augmenter</label>
 </div>
 <div class="cpn-form__row">
 <input type="radio" name="action" id="adiminishQtyFiledEdit" value="diminish">
 <label for="adiminishQtyFiledEdit" class="cpn-form__label">Dimunier</label>
 </div>
 <div class="cpn-form__row">
 <label class="cpn-form__label">Quantité <span class="cpn-form__label-required">*</span></label>
 <input type="number" name="qty" class="cpn-form__label" required>
 </div>
 <div class="cpn-form__row">
 <label class="cpn-form__label">Observation <span class="cpn-form__label-required">*</span></label>
 <textarea name="observation" class="cpn-form__label" required></textarea>
 </div>
 
 <div class="cpn-form__bottom">
 <button class="cpn-btn cpn-form__btn" data-action="cancel">Annuler</button>
 <button class="cpn-btn cpn-form__btn" name="submit" data-action="submit">Valider</button>
 </div>
 </form>
 </div>
 `;

                            const form = modalInner.querySelector(`form#${formId}`);
                            if (form) {
                                const btn = form.querySelector(
                                    'button[data-action="submit"]'
                                );
                                if (!btn) return;

                                //===>>> SEND FORM
                                const submitCallBack = (arg) => {
                                    const {
                                        data,
                                        showFormError,
                                        emptyKeys,
                                        successFormSubmit,
                                    } = arg;
                                    if (emptyKeys?.length > 0) {
                                        showFormError(
                                            "Désolé, veuillez renseigner les champs obligatoires."
                                        );
                                    } else {
                                        const isAdd = data.action === "add" ? true : false;
                                        const qty = Number(data.qty);
                                        const newStock = isAdd ? stock + qty : stock - qty;
                                        if (newStock >= 0) {
                                            const formData = new FormData();
                                            formData.append("userId", userId);
                                            formData.append(
                                                "system_logs_category_id",
                                                `${isAdd ? "3" : "4"}`
                                            );
                                            formData.append(
                                                "cause",
                                                `<div>${isAdd ? "Ajout" : "Dimunition"
                                                } de ${qty}</div> ${data.observation}`
                                            );
                                            formData.append(
                                                "dataItem",
                                                JSON.stringify({
                                                    stock: newStock,
                                                })
                                            );
                                            AppFetch(
                                                `${baseUrl}_api/products/update/${subsidiaryProductId}`,
                                                {
                                                    method: "POST",
                                                    body: formData,
                                                }
                                            ).then((responseUpdateProduct) => {
                                                if (responseUpdateProduct?.status === "success") {
                                                    successFormSubmit({ refresh: true });
                                                } else {
                                                    showFormError(
                                                        responseUpdateProduct?.message ??
                                                        `Désolé, La modifiaction a échouée!`
                                                    );
                                                }
                                            });
                                        } else {
                                            showFormError(
                                                `Désolé, le stock actuellement disponible est inférieur à votre demande!`
                                            );
                                        }
                                    }
                                };
                                FormControlSubmit({ form, btn, submitCallBack });
                            }

                            modalContent.appendChild(modalInner);
                            return modalContent;
                        };

                        btnChangeStockBtn.addEventListener("click", (e) => {
                            e.preventDefault();
                            const modal = new MODAL({
                                id: "modalNewProduct",
                                className: "wdg-modal--default",
                                modalContent: modalContent(),
                                width: "400px",
                            });
                        });
                    }
                },
            });

            //==> OPEN MENU
            menuBtn.addEventListener("click", (e) => {
                e.preventDefault();
                dropdown.create(e);
            });
        }

        TR.setAttribute("data-id", productId);
        schema.appendChild(TR);

        return schema;
    };

    new PAGINATION({
        targetId: _VAR.pgStockMainId,
        className: "pg--product-list",
        data: subsidiaryProducts.sort((a, b) => a.name.localeCompare(b.name)),
        thead,
        bodyListSchema: schema,
        limit: 20,
        navTopSelector: null,
        filters: [
            {
                selector: "status",
                label: "Statut",
                data: [
                    {
                        value: -1,
                        label: "Tout",
                        color: "#363740",
                        selected: true,
                    },
                    {
                        value: 1,
                        label: "Désactivés",
                        color: "#f0a61c",
                        selected: false,
                    },

                    {
                        value: 2,
                        label: "activés",
                        color: "#00aa4d",
                        selected: false,
                    },
                    {
                        value: 0,
                        label: "Bloqués",
                        color: "#ff0000",
                        selected: false,
                    },
                ],
            },
        ],
        actionsBtns: [
            {
                label: "Version Pdf",
                actionName: "download",
                svg: `
 <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
 viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve">
 <g>
 <path d="M50.95,12.187l-0.771-0.771L40.084,1.321L39.313,0.55C38.964,0.201,38.48,0,37.985,0H8.963C7.777,0,6.5,0.916,6.5,2.926V39
 v16.537V56c0,0.837,0.842,1.653,1.838,1.91c0.05,0.013,0.098,0.032,0.15,0.042C8.644,57.983,8.803,58,8.963,58h40.074
 c0.16,0,0.319-0.017,0.475-0.048c0.052-0.01,0.1-0.029,0.15-0.042C50.658,57.653,51.5,56.837,51.5,56v-0.463V39V13.978
 C51.5,13.211,51.408,12.645,50.95,12.187z M47.935,12H39.5V3.565L47.935,12z M8.963,56c-0.071,0-0.135-0.026-0.198-0.049
 C8.609,55.877,8.5,55.721,8.5,55.537V41h41v14.537c0,0.184-0.109,0.339-0.265,0.414C49.172,55.974,49.108,56,49.037,56H8.963z
 M8.5,39V2.926C8.5,2.709,8.533,2,8.963,2h28.595C37.525,2.126,37.5,2.256,37.5,2.391V14h11.609c0.135,0,0.264-0.025,0.39-0.058
 c0,0.015,0.001,0.021,0.001,0.036V39H8.5z"/>
 <path d="M22.042,44.744c-0.333-0.273-0.709-0.479-1.128-0.615c-0.419-0.137-0.843-0.205-1.271-0.205h-2.898V54h1.641v-3.637h1.217
 c0.528,0,1.012-0.077,1.449-0.232s0.811-0.374,1.121-0.656c0.31-0.282,0.551-0.631,0.725-1.046c0.173-0.415,0.26-0.877,0.26-1.388
 c0-0.483-0.103-0.918-0.308-1.306S22.375,45.018,22.042,44.744z M21.42,48.073c-0.101,0.278-0.232,0.494-0.396,0.649
 c-0.164,0.155-0.344,0.267-0.54,0.335c-0.196,0.068-0.395,0.103-0.595,0.103h-1.504v-3.992h1.23c0.419,0,0.756,0.066,1.012,0.198
 c0.255,0.132,0.453,0.296,0.595,0.492c0.141,0.196,0.234,0.401,0.28,0.615c0.045,0.214,0.068,0.403,0.068,0.567
 C21.57,47.451,21.52,47.795,21.42,48.073z"/>
 <path d="M31.954,45.4c-0.424-0.446-0.957-0.805-1.6-1.073s-1.388-0.403-2.235-0.403h-3.035V54h3.814
 c0.127,0,0.323-0.016,0.588-0.048c0.264-0.032,0.556-0.104,0.875-0.219c0.319-0.114,0.649-0.285,0.991-0.513
 s0.649-0.54,0.923-0.937s0.499-0.889,0.677-1.477s0.267-1.297,0.267-2.126c0-0.602-0.105-1.188-0.314-1.757
 C32.694,46.355,32.378,45.847,31.954,45.4z M30.758,51.73c-0.492,0.711-1.294,1.066-2.406,1.066h-1.627v-7.629h0.957
 c0.784,0,1.422,0.103,1.914,0.308s0.882,0.474,1.169,0.807s0.48,0.704,0.581,1.114c0.1,0.41,0.15,0.825,0.15,1.244
 C31.496,49.989,31.25,51.02,30.758,51.73z"/>
 <polygon points="35.598,54 37.266,54 37.266,49.461 41.477,49.461 41.477,48.34 37.266,48.34 37.266,45.168 41.9,45.168 
 41.9,43.924 35.598,43.924 "/>
 <path d="M38.428,22.961c-0.919,0-2.047,0.12-3.358,0.358c-1.83-1.942-3.74-4.778-5.088-7.562c1.337-5.629,0.668-6.426,0.373-6.802
 c-0.314-0.4-0.757-1.049-1.261-1.049c-0.211,0-0.787,0.096-1.016,0.172c-0.576,0.192-0.886,0.636-1.134,1.215
 c-0.707,1.653,0.263,4.471,1.261,6.643c-0.853,3.393-2.284,7.454-3.788,10.75c-3.79,1.736-5.803,3.441-5.985,5.068
 c-0.066,0.592,0.074,1.461,1.115,2.242c0.285,0.213,0.619,0.326,0.967,0.326h0c0.875,0,1.759-0.67,2.782-2.107
 c0.746-1.048,1.547-2.477,2.383-4.251c2.678-1.171,5.991-2.229,8.828-2.822c1.58,1.517,2.995,2.285,4.211,2.285
 c0.896,0,1.664-0.412,2.22-1.191c0.579-0.811,0.711-1.537,0.39-2.16C40.943,23.327,39.994,22.961,38.428,22.961z M20.536,32.634
 c-0.468-0.359-0.441-0.601-0.431-0.692c0.062-0.556,0.933-1.543,3.07-2.744C21.555,32.19,20.685,32.587,20.536,32.634z
 M28.736,9.712c0.043-0.014,1.045,1.101,0.096,3.216C27.406,11.469,28.638,9.745,28.736,9.712z M26.669,25.738
 c1.015-2.419,1.959-5.09,2.674-7.564c1.123,2.018,2.472,3.976,3.822,5.544C31.031,24.219,28.759,24.926,26.669,25.738z
 M39.57,25.259C39.262,25.69,38.594,25.7,38.36,25.7c-0.533,0-0.732-0.317-1.547-0.944c0.672-0.086,1.306-0.108,1.811-0.108
 c0.889,0,1.052,0.131,1.175,0.197C39.777,24.916,39.719,25.05,39.57,25.259z"/>
 </g>
 </svg>
 `,
                className: "custum-className",
                callBack: (currentData) => {
                    console.log("currentData", currentData)
                    const modalContent = () => {
                        const modalContent = document.createDocumentFragment();
                        const className = "modal-generate-product";
                        const formId = "generate-product-form";
                        const modalInner = document.createElement("div");
                        modalInner.classList = className;
                        modalInner.innerHTML = `
 <div class="ui-modal__head">
 <h2 class="ui-modal__title">Configurer la liste des produits</h2>
 </div>
 <form method="post" class="cpn-form" id="${formId}" style="padding:15px; ">
 <div class="cpn-form__row">
 <input type="checkbox" class="cpn-field" name="stock" id="stock" checked="checked">
 <label for="stock" class="cpn-form__label">Quantité</label>
 </div>
 <div class="cpn-form__row">
 <input type="checkbox" class="cpn-field" name="buying_price" id="buying_price"">
 <label for="buying_price" class="cpn-form__label">Prix d'achat</label>
 </div>
 <div class="cpn-form__row">
 <input type="checkbox" class="cpn-field" name="selling_price" id="selling_price"">
 <label for="selling_price" class="cpn-form__label">Prix de vente</label>
 </div>
 <div class="cpn-form__row">
 <input type="checkbox" class="cpn-field" name="profit" id="profit"">
 <label for="profit" class="cpn-form__label">Bénéfice</label>
 </div>
 <div class="cpn-form__row">
 <input type="checkbox" class="cpn-field" name="qty_stock_alert" id="qty_stock_alert"">
 <label for="qty_stock_alert" class="cpn-form__label">Stock alerte</label>
 </div>
 <div class="cpn-form__bottom">
 <button class="cpn-btn cpn-form__btn" name="submit" data-action="submit">Générer</button>
 </div>
 </form>
 
 `
                        const form = modalInner.querySelector(`form#${formId}`);
                        if (form) {
                            const btn = form.querySelector('button[data-action="submit"]');
                            if (!btn) return

                            //===>>> SEND FORM
                            const submitCallBack = (arg) => {

                                const { data, showFormError, emptyKeys, successFormSubmit } = arg
                                console.log(data)
                                if (Object.keys(data).length < 1) {
                                    showFormError(
                                        "Désolé, veuillez cocher au moin un champ."
                                    )
                                } else {
                                    const formData = new FormData()
                                    formData.append("name", "products")
                                    formData.append("data", JSON.stringify({
                                        config: data,
                                        currentData: currentData
                                    }));
                                    AppFetch(`${baseUrl}_api/products/liveContentSession`, {
                                        method: "POST",
                                        body: formData,
                                    }).then((response) => {
                                        if (response?.status === 'success') {
                                            modal.close()
                                            window.open(
                                                `${baseUrl}managers/stocks/pdf_products`,
                                                "_blank"
                                            );
                                        } else {
                                            console.log("response", response);
                                        }
                                    })
                                }
                            }
                            FormControlSubmit({ form, btn, submitCallBack })

                        }

                        modalContent.appendChild(modalInner)
                        return modalContent
                    }

                    const modal = new MODAL({
                        id: "modalGenerateProduct",
                        className: "wdg-modal--default",
                        modalContent: modalContent(),
                        width: "500px",
                    });
                },
            },
        ],
    });
} 