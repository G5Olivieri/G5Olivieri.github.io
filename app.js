const html = elementByTagName('html')
const head = elementByTagName('head')
const body = elementByTagName('body')

function element(str) {
    return document.createElement(str.toUpperCase())
}

function hierarchy() {
    for(var i = 0; i < arguments.length-1; i++) {
        arguments[i].appendChild(arguments[i+1])
    }
    return arguments[0]
}

function querySelector(query) {
    return document.querySelectorAll(query)
}

function onclick(element, fun) {
    element.onclick = fun
    return element
}

function append(element, el) {
    element.appendChild(el)
    return element
}

function add(element) {
    for(var i = 1; i < arguments.length; i++) {
        append(element, arguments[i])
    }
    return element
}

function setAttribute(element, attr, val) {
    element.setAttribute(attr, val);
    return element
}

function setAttributes(element) {
    for(var i = 1; i < arguments.length-1; i += 2) {
        setAttribute(element, arguments[i], arguments[i+1])
    }
    return element
}

function getAttribute(element, str) {
    return element.getAttribute(str)
}

function removeAttribute(element, str) {
    element.removeAttribute(str)
    return element
}

function elementsByTagName(str) {
    return document.getElementsByTagName(str)
}

function elementById(id) {
    return document.getElementById(id)
}

function elementByTagName(str) {
    return elementsByTagName(str)[0]
}

function text(element, str) {
    element.innerText = str
    return element
}

function addClass(element, className) {
    return setClass(element, element.className + className)
}

function setClass(element, className) {
    element.className = className
    return element
}

function setId(element, id) {
    return setAttribute(element, 'id', id)
}

function onload(element, fun) {
    element.onload = fun
    return element
}

function addStyle(path) {
    var link = element('link')
    setAttribute(link, 'rel', 'stylesheet')
    setAttribute(link, 'href', path)
    add(
        head,
        link
    )
}

function init() {
    setAttribute(
    html,
    'lang', 'pt-br'
    )

    add(
        html, 
        head,
        body
    )
}

function start() {
    setTimeout(init, 20)
}

start()

add(
    body,
    setId(
        element('div'),
        'app'
    )
)

var app = elementById('app')

addStyle('./style.css')

var li = function(str) {
    return add(
        element('li'),
        text(
            setAttribute(
                element('a'),
                'href', '#'
            ),
            str
        )
    )
}

var line = function(){
    return setClass(
        element('span'),
        'line'
    )
}

var menu = hierarchy(
    setClass(
        element('li'),
        'menu-list-item'
    ),
    setClass(
        setAttribute(
            element('a'),
            'href', '#'
        ),
        'menu'
    ),
    add(
        setClass(
            element('div'),
            'menu-icon'
        ),
        line(),
        line(),
        line()
    )
)

var ul = [menu, li('Home'), li('Documentation'), li('Example')]

add(
    app,
    hierarchy(
        element('header'),
        element('nav'),
        add(
            element('ul'),
            ...ul
        )
    )
)

add(
    app,
    setClass(element('div'), 'jumbotron'),
    add(
        setClass(
            element('div'),
            'container'
        ),
        text(
            setClass(
                element('h1'),
                'title'
            ),
            'Glayson Framework'
        ),
        text(
            element('p'),
            'Esse framework Js não é oficial em porra nenhuma'
            + ' não serve pra nada, somente para o Glayson aprender'
            + ' a usar melhor o recurso funcional do JavaScript.'
        )
    )
)

var menu = []

for(var i = 0; i < 3; i++) {
    menu.push(li('teste' + i))
}

add(
    querySelector('.menu-list-item')[0],
    setClass(
        add(
            element('ul'),
            ...menu
        ),
        'menu-nav'
    ),
    setId(
        element('div'),
        'nav-bar-background'
    )
)

onclick(querySelector('li.menu-list-item')[0], function() {
    if(getAttribute(this, 'active') == null) {
        setAttribute(this, 'active', 'true')
    } else {
        removeAttribute(this, 'active')
    }
})