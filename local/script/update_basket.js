$('body').on('click', '.basket-icon', function () {
    const product_button = $(this);
    const product_card = product_button.parent().parent();
    const product_image = product_card.find('.product-card__image');
    const product_id = product_card.data('id');
    const cart_count = $('.cart__count');
    //Добавление в корзину
    if (!product_button.hasClass('basket-icon_active')) {

        const icon_menu = $('.icon-menu');
        const cart = $('.cart');

        var animate_position = window.innerWidth > 767 ? cart.offset() : icon_menu.offset();

        const card_clone = product_card.find('.product-card__image').clone().addClass('product-card__image_fly');
        product_image.after(card_clone);
        card_clone.offset(
            {
                left: animate_position.left - 50,
                top: animate_position.top + 10,
            }
        );
        card_clone.animate(
            {
                width: 75,
                height: 75,
                opacity: 0,

            },
            900,
            function () {
                card_clone.remove();
            }
        );
        $.ajax(
            {
                url: '/php/add_basket.php',
                type: 'post',
                data: {
                    id: product_id,
                },
                success: function (data) {
                    product_button.addClass('basket-icon_active')
                    cart_count.text(data);
                }, error: function () {
                    alert("Ошибка");
                }
            }
        );
    }

    //Удалени из корзины
    if (product_button.hasClass('basket-icon_active')) {
        $.ajax(
            {
                url: '/php/del_basket.php',
                type: 'post',
                data: {
                    id: product_id,
                },
                success: function (data) {
                    product_button.removeClass('basket-icon_active')
                    cart_count.text(data['cart__count']);
                }, error: function () {
                    alert("Ошибка");
                },
                dataType: 'json'
            }
        );
    }
});





