//require('./bootstrap');

const CURRENCY_CONVERTER_API_KEY = '1cxz8d7c7zx8wq7as9ad23asd72';
// const CURRENCY_CONVERTER_HOST = 'http://localhost:81';
const CURRENCY_CONVERTER_HOST = 'https://ccapi.firefly.usermd.net';

/**
 * TODO! Remove console.logs before deploy!
 *
 * Add management for Currency Converter
 *
 * @return void
 */
const currencyConverterTrigger = () => {
    const currenciesConverter = document.querySelector('.currency-calc-form');
    if (currenciesConverter === null) {
        return;
    }

    const loaderOn = () => {
        currenciesConverter.parentElement.classList.add('loading');
    };

    const loaderOff = () => {
        currenciesConverter.parentElement.classList.remove('loading');
    };

    loaderOff();

    const apiUrlPath = new URL(CURRENCY_CONVERTER_HOST + currenciesConverter.getAttribute('action'));

    let errorText = document.querySelector('.error-text');

    currenciesConverter.addEventListener('change', (e) => {
        console.log('Changed!');

        let changedTarget = e.target.getAttribute('data-currency-symbol');

        let pln = currenciesConverter.querySelector('input[data-currency-symbol="PLN"]');
        let sgd = currenciesConverter.querySelector('input[data-currency-symbol="SGD"]');

        let apiUrl = apiUrlPath;

        apiUrl.searchParams.append('from', changedTarget === 'PLN' ? 'PLN' : 'SGD');
        apiUrl.searchParams.append('to', changedTarget === 'PLN' ? 'SGD' : 'PLN');
        apiUrl.searchParams.append('value', changedTarget === 'PLN' ? pln.value : sgd.value);
        apiUrl.searchParams.append('api_key', CURRENCY_CONVERTER_API_KEY);

        if (currenciesConverter.value !== null) {
            loaderOn();
            console.log('API call!');

            fetch(apiUrl)
                .then((res) => res.json())
                .then((res) => {
                    console.log(res);
                    if (changedTarget === 'PLN') {
                        sgd.value = res.data.value;
                    } else {
                        pln.value = res.data.value;
                    }
                    if (errorText.classList.contains('active')) {
                        errorText.classList.remove('active');
                    }
                    loaderOff();
                })
                .catch((err) => {
                    console.error(err);
                    errorText.classList.add('active');
                    loaderOff();
                });;
        }
    });
};

/**
 * Run CurrencyConverterTrigger
 */
currencyConverterTrigger();
