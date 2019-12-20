$(function () {
    function createCategory(el) {
        let option = `<option value="${el.id}">${el.name}</option>`;
        $('#category-ml').append(option);
    }

    let info = $('#ml-info');

    axios.get('https://api.mercadolibre.com/sites/MLB/category_predictor/predict?title=' + info.data('name'))
        .then(function (response) {
            response.data.path_from_root.forEach(createCategory);
        }).catch(function (error) {
        console.log(error);
    });
});
