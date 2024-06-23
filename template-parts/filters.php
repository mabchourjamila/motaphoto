<div class="filtres">

    <!-- Création du menu déroulant Catégories des photos -->

    <div class="bloc-filtre">
        <div class="menu-deroulant" id="categorie-titre">
            <div class="menu-titre visible">Catégories</div>
            <div class="menu-titre cache">Catégories</div>
            <i class="fa-solid fa-chevron-down menu-fleche" style="color: #000000;"></i>
        </div>
        <div class="menu-options" id="categorie-options">
            <?php

            echo '<div class="vide" id="categorie-vide"></div>';

            $possibilites = get_terms('categoriesphotos');
            if (!empty($possibilites) && !is_wp_error($possibilites)) {
                foreach ($possibilites as $possibilite) {
                    echo '<div class="menu-option" id="' . esc_attr($possibilite->slug) . '">' . esc_html($possibilite->name) . '</div>';
                }
            }
            ?>
        </div>
    </div>

    <!-- Création du menu déroulant Formats des photos -->

    <div class="bloc-filtre">
        <div class="menu-deroulant" id="format-titre">
            <div class="menu-titre visible">Formats</div>
            <div class="menu-titre cache">Formats</div>
            <i class="fa-solid fa-chevron-down menu-fleche" style="color: #000000;"></i>
        </div>
        <div class="menu-options" id="format-options">
            <?php

            echo '<div class="vide" id="format-vide"></div>';

            $termes = get_terms('formats');

            if (!empty($termes) && !is_wp_error($termes)) {
                foreach ($termes as $terme) {
                    echo '<div class="menu-option" id="' . esc_attr($terme->slug) . '">' . esc_html($terme->name) . '</div>';
                }
            }
            ?>
        </div>
    </div>

    <!-- Création du menu déroulant Trier par date de pub lication ASC et DESC des photos -->

    <div class="bloc-filtre" id="filtre-tri">
        <div class="menu-deroulant" id="tri-titre">
            <div class="menu-titre visible">Trier par</div>
            <div class="menu-titre cache">Trier par</div>
            <i class="fa-solid fa-chevron-down menu-fleche" style="color: #000000;"></i>
        </div>
        <div class="menu-options" id="tri-options">
            <div class="vide" id="tri-vide"></div>
            <div class="menu-option" id="ASC">Des plus anciennes aux plus récentes</div>
            <div class="menu-option" id="DESC">Des plus récentes aux plus anciennes</div>
        </div>
    </div>

</div>