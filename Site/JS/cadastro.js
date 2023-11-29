function formatPhone(obj, e) {
    if ((e.keyCode >= 37 && e.keyCode <= 40) || e.keyCode == 8 || e.keyCode == 46) return;
    var numbers = obj.value.replace(/\D/g, ''),
        char = { 0: '(', 2: ') ', 7: '-' };
    obj.value = '';
    for (var i = 0; i < numbers.length; i++) {
        obj.value += (char[i] || '') + numbers[i];
    }
}