module.exports = {
    init: $ => {
        const uploads = $(".form-item__upload");
        const main = $("main");

        const modalGeneric = $(".modal__generic");
        const modalScope = {
            title: modalGeneric.find(".modal__generic__title"),
            content: modalGeneric.find(".modal__generic__content")
        };
        if (uploads.length && !main.hasClass("subscription--completed")) {
            uploads.each((i, el) => {
                module.exports.activeRemove($, $(el));
                const scope = {
                    image: $(el).find("input.image"),
                    doc: $(el).find("input.doc"),
                    wrapper: $(el).find(".form-item__upload__item"),
                    imageSizeLimit: 5 * 1024 * 1024,
                    docSizeLimit: 15 * 1024 * 1024,
                    imageSupports: ["image/jpeg"],
                    docSupports: [
                        "application/pdf",
                        "application/vnd.ms-powerpoint",
                        "application/msword",
                        "application/vnd.openxmlformats-officedocument.presentationml.presentation",
                        "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                    ]
                };
                scope.image.change(e => {
                    let files = e.target.files || e.dataTransfer.files;

                    if (files.length) {
                        e.target
                            .closest(".form-item__upload__item__btn")
                            .classList.add("uploaded");
                        let files = e.target.files;
                        $.LoadingOverlay("show");
                        for (let i = 0; i < files.length; i++) {
                            let file = files[i];

                            const support = scope.imageSupports.find(e => {
                                return `${e}` == `${file.type}`;
                            });

                            if (!support) {
                                modalScope.content.html(
                                    `<p>O arquivo ${file.name} não possui um formato aceito.</p>`
                                );
                                modalGeneric.addClass("modal--active");
                                continue;
                            } else if (file.size > scope.imageSizeLimit) {
                                modalScope.content.html(
                                    `<p>O arquivo ${file.name} está sendo desconsiderado pois ultrapassa o limite de 5MB.</p>`
                                );
                                modalGeneric.addClass("modal--active");
                                continue;
                            } else {
                                let reader = new FileReader();
                                reader.onload = function (event) {
                                    let picFile = event.target;
                                    let html = `
                              <div class="form-item__upload__item__image">
                                 <div class="form-item__upload__item__image__wrapper">
                                    <input type="hidden" name="images[][file]" value="${picFile.result}" />
                                    <input type="hidden" name="images[][name]" value="${file.name}" />
                                    <img src="${picFile.result}" />
                                 </div>
                                 <button class="btn btn--small btn--border btn__removeUpload">apagar imagem</button>
                              </div>`;
                                    scope.wrapper.append(html);
                                    module.exports.activeRemove($, $(el));
                                };
                                reader.readAsDataURL(file);
                            }
                        }
                        $.LoadingOverlay("hide");
                    }
                });

                scope.doc.change(e => {
                    let files = e.target.files || e.dataTransfer.files;
                    if (files.length) {
                        e.target
                            .closest(".form-item__upload__item__btn")
                            .classList.add("uploaded");
                        let files = e.target.files;
                        $.LoadingOverlay("show");
                        for (let i = 0; i < files.length; i++) {
                            let file = files[i];

                            const support = scope.docSupports.find(e => {
                                return `${e}` == `${file.type}`;
                            });

                            if (!support) {
                                modalScope.content.html(
                                    `<p>O arquivo ${file.name} não possui um formato aceito.</p>`
                                );
                                modalGeneric.addClass("modal--active");
                                continue;
                            } else if (file.size > scope.docSizeLimit) {
                                modalScope.content.html(
                                    `<p>O arquivo ${file.name} está sendo desconsiderado pois ultrapassa o limite de 15MB.</p>`
                                );
                                modalGeneric.addClass("modal--active");
                                continue;
                            } else {
                                let reader = new FileReader();
                                reader.onload = function (event) {
                                    let docFile = event.target;
                                    let html = `
                              <div class="form-item__upload__item__document">
                                 <div class="form-item__upload__item__document__wrapper">
                                    <input type="hidden" name="documents[][file]" value="${docFile.result}" />
                                    <input type="hidden" name="documents[][name]" value="${file.name}" />
                                    <img src="/images/document.png" />
                                 </div>
                                 <span class="form-item__upload__item__document__title">${file.name}</span>
                                 <button class="btn btn--small btn--border btn__removeUpload">apagar documento</button>
                              </div>`;
                                    scope.wrapper.append(html);
                                    module.exports.activeRemove($, $(el));
                                };
                                reader.readAsDataURL(file);
                            }
                        }
                        // console.log("FIM PROCESSAMENTO")
                        $.LoadingOverlay("hide");
                    }
                });
            });
        }
    },
    activeRemove: ($, element, index) => {
        const remove = element.find(".btn__removeUpload");
        remove.each((i, el) => {
            $(el).click(e => {
                e.preventDefault();
                element
                    .find(".form-item__upload__item__btn")
                    .removeClass("uploaded");
                $(el)
                    .closest("div")
                    .remove();
            });
        });
    }
};
