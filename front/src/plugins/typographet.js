

const defaults = {
    prepositions: ["в","во","без","до","из","«из","к","ко","на","по","о","от","с","у","не","за","над","для","об","под","про","и","а","но","да","или","ли","бы","то","что","как","я","он","мы","они","ни","же","вы","им"],
    nbsp: '&nbsp;'
};
function addNbsp(elem, settings) {
    var nbsp = settings.nbsp,
        prepositions = settings.prepositions.map(function (item) {
            return ' ' + item + ' ';
        }),
        prepositions2 = settings.prepositions.map(function (item) {
            return '&nbsp;' + item + ' ';
        }),
        regex = new RegExp( prepositions.join('|'), 'gi' ),
        regex2 = new RegExp( prepositions2.join('|'), 'gi' ),
        replacement = function (str) {
            return str.slice(0, -1) + nbsp;
        };

    var str = elem.innerHTML
    str = str.replace(regex, replacement)
    str = str.replace(regex2, replacement);
    elem.innerHTML = str
}


const items = document.querySelector('.page')
addNbsp(items, defaults)
