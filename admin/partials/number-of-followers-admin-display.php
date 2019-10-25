<form method="post" name="my_options" action="options.php">
<?php

// Загрузить все значения элементов формы
$options = get_option($this->plugin_name);

// текущие состояние опций
$access_token = $options['access_token'];

// Выводит скрытые поля формы на странице настроек
settings_fields( $this->plugin_name );
do_settings_sections( $this->plugin_name );
?>
    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
    <p>Для того чтобы пользоватьcя данным плагином нужно ввести access_token вашего профиля instagram</p>
    <p>Простейший способ получения <a href="https://instagram.pixelunion.net/">здесь</a></p>
        <label for="<?php echo $this->plugin_name;?>-access_token">
            <span><?php esc_attr_e('Your access token', $this->plugin_name);?></span>
        </label>
        <input type="text"
               class="regular-text" id="<?php echo $this->plugin_name;?>-access_token"
               name="<?php echo $this->plugin_name;?>[access_token]"
               value="<?php if(!empty($access_token)) esc_attr_e($access_token, $this->plugin_name);?>"
               placeholder="<?php esc_attr_e('Enter access token', $this->plugin_name);?>"
        />
    <p>The count of followers:
        <?php
            if (!empty($access_token)) {
                $count_followers = $this->get_count_followers();
                echo $count_followers ? $count_followers : 'Введенный access token не корректен';
            }
        ?>
    </p>
    <?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>

</form>
