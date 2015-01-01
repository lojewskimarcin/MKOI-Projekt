jQuery(window).load(function () {
    checkVisibility();
    /**
     * Show panel if checkbox is selected.
     */
    $('#blum-micali_cb').click(function () {
        $("#blum-micali_pnl").fadeToggle();
        checkVisibility();
    });

    /**
     * Show panel if checkbox is selected.
     */
    $('#rsa_cb').click(function () {
        $("#rsa_pnl").fadeToggle();
        checkVisibility();
    });
});

/**
 * Manage visibility of elements
 */
function checkVisibility() {
    var bmcb = $('#blum-micali_cb');
    var rsacb = $('#rsa_cb');
    if (bmcb.prop('checked') || rsacb.prop('checked')) {
        $('#submit_btn').attr("disabled", false);
    } else {
        $('#submit_btn').attr("disabled", true);
    }
    if (bmcb.prop('checked')) {
        $("#blum-micali_pnl").fadeIn();
    } else {
        $("#blum-micali_pnl").fadeOut();
    }
    if (rsacb.prop('checked')) {
        $("#rsa_pnl").fadeIn();
    } else {
        $("#rsa_pnl").fadeOut();
    }
}

/**
 * Validates all input data
 *
 * @param button button clicked
 */
function validate(button) {
    $('.has-error.has-feedback').removeClass('has-error has-feedback');
    $('span.glyphicon.glyphicon-remove.form-control-feedback').remove();
    var errorMessage = '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
    var error = false;
    if ($('#blum-micali_cb').prop('checked')) {
        var fnbm = $('#first_num_bm');
        if (!isNaturalNumber(fnbm.val()) || !isPrime(fnbm.val())) {
            fnbm.after(errorMessage);
            fnbm.parent().addClass('has-error has-feedback');
            error = true;
        }
        var snbm = $('#second_num_bm');
        if (!isNaturalNumber(snbm.val()) || !isPrime(snbm.val())) {
            snbm.after(errorMessage);
            snbm.parent().addClass('has-error has-feedback');
            error = true;
        }
        var sbm = $('#seed_bm');
        if (!isNaturalNumber(sbm.val())) {
            sbm.after(errorMessage);
            sbm.parent().addClass('has-error has-feedback');
            error = true;
        }
        var mnbm = $('#max_number_bm');
        if (!isNaturalNumber(mnbm.val())) {
            mnbm.after(errorMessage);
            mnbm.parent().addClass('has-error has-feedback');
            error = true;
        }
        var cbm = $('#count_bm');
        if (!isNaturalNumber(cbm.val())) {
            cbm.after(errorMessage);
            cbm.parent().addClass('has-error has-feedback');
            error = true;
        }
    }
    if ($('#rsa_cb').prop('checked')) {
        var fnrsa = $('#first_num_rsa');
        if (!isNaturalNumber(fnrsa.val()) || !isPrime(fnrsa.val())) {
            fnrsa.after(errorMessage);
            fnrsa.parent().addClass('has-error has-feedback');
            error = true;
        }
        var snrsa = $('#second_num_rsa');
        if (!isNaturalNumber(snrsa.val()) || !isPrime(snrsa.val())) {
            snrsa.after(errorMessage);
            snrsa.parent().addClass('has-error has-feedback');
            error = true;
        }
        var cnrsa = $('#coprime_num_rsa');
        if (!isNaturalNumber(cnrsa.val()) || !isNaturalNumber(fnrsa.val()) || !isNaturalNumber(snrsa.val())
            || !areCoprime(cnrsa.val(), fnrsa.val(), snrsa.val())) {
            cnrsa.after(errorMessage);
            cnrsa.parent().addClass('has-error has-feedback');
            error = true;
        }
        var srsa = $('#seed_rsa');
        if (!isNaturalNumber(srsa.val()) || !isNaturalNumber(fnrsa.val()) || !isNaturalNumber(snrsa.val())
            || !(srsa.val() < fnrsa.val() * snrsa.val())) {
            srsa.after(errorMessage);
            srsa.parent().addClass('has-error has-feedback');
            error = true;
        }
        var crsa = $('#count_rsa');
        if (!isNaturalNumber(crsa.val())) {
            crsa.after(errorMessage);
            crsa.parent().addClass('has-error has-feedback');
            error = true;
        }
    }
    return !error;
}

/**
 * Checks if supplied number is a prime number
 *
 * @param number number to check
 *
 * @returns {boolean} if supplied number is a prime number
 */
function isPrime(number) {
    if (number < 3) {
        return false;
    }
    /* It's more efficient, javascript doesn't support BIG integers */
    if (number > Math.pow(2, 30)) {
        var isPrime = false;
        $.ajax({
            url: 'api/isPrime/' + number,
            async: false,
            dataType: 'json',
            error: function () {
                alert('Error, while connecting to server. Please try again.');
            },
            success: function (response) {
                if (response['isPrime'] === true) {
                    isPrime = true;
                }
            }
        });
        return isPrime;
    }
    else {
        var max = Math.ceil(Math.sqrt(number));
        for (i = 2; i <= max; i++) {
            if (number % i === 0) {
                return false;
            }
            return true;
        }
    }
}

/**
 * Checks if supplied number is coprime with (number1 - 1) * (number2 - 1)
 *
 * @param number number to check
 * @param number1 number to check
 * @param number2 number to check
 *
 * @returns {boolean} if supplied numbers are coprime numbers
 */
function areCoprime(number, number1, number2) {
    if (number < 2 || number1 < 2 || number2 < 2) {
        return false;
    }
    /* It's more efficient, javascript doesn't support BIG integers */
    var pow = Math.pow(2, 15);
    if (number > pow || number1 > pow || number2 > pow) {
        var areCoprime = false;
        $.ajax({
            url: 'api/areCoprime/' + number + ',' + number1 + ',' + number2,
            async: false,
            dataType: 'json',
            error: function () {
                alert('Error, while connecting to server. Please try again.');
            },
            success: function (response) {
                if (response['areCoprime'] === true) {
                    areCoprime = true;
                }
            }
        });
        return areCoprime;
    }
    else {
        var gcd = function (a, b) {
            if (!b) {
                return a;
            }

            return gcd(b, a % b);
        };
        if (gcd(number, ((number1 - 1) * (number2 - 1))) === 1) {
            return true;
        }
        return false;
    }
}

/**
 * Check if supplied number is a natural number
 * @param number number to check
 *
 * @returns {boolean} if supplied number is a natural number
 */
function isNaturalNumber(number) {
    return !(number.indexOf('-') > -1) && !(number.indexOf('.') > -1) && !isNaN(number) && number != 0;
}
