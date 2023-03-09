<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>

<?php if (!empty($arResult['ITEMS'])) { ?>
    <div class="reviews">
        <div class="reviews__container ">
            <?php foreach ($arResult['ITEMS'] as $arItem) { ?>
                <div class="reviews__item">
                    <div class="reviews__section">
                        <a href="#" class="reviews__logo">
                            <img src="<?= $arItem['PREVIEW_PICTURE'] ?? SITE_TEMPLATE_PATH . '/assets/icon/personal/unknow-user.png' ?>"
                                 alt="">
                        </a>
                        <div class="reviews__info">
                            <div class="reviews__info-top">
                                <a href="#" class="reviews__name"><?= $arItem['PROPERTY_USER_NAME_VALUE'] ?></a>
                                <div class="reviews__date"><?= $arItem['PROPERTY_DATE_VALUE'] ?></div>
                            </div>
                            <div class="reviews__info-bottom">
                                <div class="rating">
                                    <div class="rating__body">
                                        <div class="rating__value"
                                             data-value="<?= $arItem['PROPERTY_RATING_VALUE'] ?>"></div>
                                        <div class="rating__items">
                                            <div type="radio" class="rating__item" value="" name="rating"></div>
                                            <div type="radio" class="rating__item" value="" name="rating"></div>
                                            <div type="radio" class="rating__item" value="" name="rating"></div>
                                            <div type="radio" class="rating__item" value="" name="rating"></div>
                                            <div type="radio" class="rating__item" value="" name="rating"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php foreach ($arItem['PROPERTY_PARAMS_VALUE'] as $key => $value) { ?>
                                    <div class="reviews__params"><?= $value ?>:
                                        <span><?= $arItem['PROPERTY_PARAMS_DESCRIPTION'][$key] ?></span>
                                    </div>
                                <?php } ?>

                            </div>

                        </div>
                    </div>
                    <div class="reviews__section reviews__section_mobile">
                        <div class="reviews__info">
                            <div class="reviews__info-bottom">
                                <div class="reviews__params reviews__params_mobile">Цвет:
                                    <span><?= $arItem['PROPERTY_COLOR_VALUE'] ?></span></div>
                                <div class="reviews__params reviews__params_mobile">Размер:
                                    <span><?= $arItem['PROPERTY_SIZE_VALUE'] ?></span></div>
                            </div>

                        </div>
                    </div>
                    <div class="reviews__section">
                        <?= $arItem['PREVIEW_TEXT'] ?>
                    </div>
                    <div class="reviews__section feedback">
                        <div class="reviews__comments comments">
                            <div class="comments__item">Пожаловаться на отзыв</div>
                            <div class="comments__item">Ответить</div>
                        </div>
                        <div class="reviews__likes likes">
                            <div class="likes__item" data-like="like" data-review_id="<?= $arItem['ID'] ?>">
                                <i class="likes__icon  fa-solid fa-thumbs-up
                                    <?= $arResult['REVIEWS_LIKES'][$arItem['ID']]['ACTIVE'] == 'like' ? 'likes__icon_active' : '' ?>">
                                </i>
                                <div class="likes__counter"><?= $arResult['REVIEWS_LIKES'][$arItem['ID']]['COUNTER']['LIKES'] ?? 0; ?> </div>
                            </div>
                            <div class="likes__item" data-like="dislike" data-review_id="<?= $arItem['ID'] ?>">
                                <i class="likes__icon fa-solid fa-thumbs-down
                                     <?=  $arResult['REVIEWS_LIKES'][$arItem['ID']]['ACTIVE'] == 'dislike' ? 'likes__icon_active' : '' ?>">
                                </i>
                                <div class="likes__counter"><?= $arResult['REVIEWS_LIKES'][$arItem['ID']]['COUNTER']['DISLIKES'] ?? 0; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

