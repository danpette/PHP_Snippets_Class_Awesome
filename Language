class Language {

    public function __construct() {
        $language = $this->getLanguage();
        if ($language !== false) {
            if ($language != 'en_EN') {
                putenv("LC_ALL=$language");
                setlocale(LC_ALL, $language);
                bindtextdomain('app', "locale/");
                textdomain('app');
            }
        }
        else {
            putenv("LC_ALL=nb_NO");
            $this->setLanguage('nb_NO');
            setlocale(LC_ALL, $this->getLanguage());
            bindtextdomain('app', "locale/");
            textdomain('app');
        }
    }

    public function getLanguage() {
        if (isset($_SESSION['website_language']) && strlen($_SESSION['website_language']) > 0) {
            return $_SESSION['website_language'];
        }
        return false;
    }

    public function setLanguage($language) {
        $_SESSION['website_language'] = $language;
        putenv("LC_ALL=$language");
        setlocale(LC_ALL, $language);
        bindtextdomain('app', "locale/");
        textdomain('app');
    }
}
