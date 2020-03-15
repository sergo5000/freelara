import AttributeManager from './AttributeManager';

export default class CategoryManager {
    constructor() {
        this.init = this.init.bind(this);
        this.change = this.change.bind(this);

        this.attributeManager = new AttributeManager();

        this.values = [];
        this.attributeValues = [];
        this.container;
        this.attributeContainer;

        document.addEventListener('DOMContentLoaded', this.init);
    }

    init() {
        this.initValues();
        this.initCurrentCategories();
        this.initCurrentAttributes();
    }

    initValues() {
        this.container = document.getElementById('category-container');
        if(!this.container) {
            throw new Error('CategoryManager: Category container ​​not found');
        }
        this.container.addEventListener('change', this.change);

        let el = document.getElementById('category-values');
        if(!el) {
            throw new Error('CategoryManager: Category values ​​not found');
        }

        this.values = JSON.parse(el.innerHTML);
        el.remove();

        this.addSelect(this.values);
    }

    initCurrentCategories() {
        let el = document.getElementById('category-current');
        if(!el) {
            return;
        }

        let values = el.innerHTML;
        el.remove();

        if(!values) {
            return;
        }

        let currents = JSON.parse(values);        

        for(let key in currents) {
            let item = currents[key];

            let selects = document.querySelectorAll('.category-select select');
            if(!selects.length) {
                return;
            }

            let select = selects[selects.length - 1];
            select.value = item;

            let event = new Event('change', {bubbles : true, cancelable : false});
            select.dispatchEvent(event);
        }        
    }

    initCurrentAttributes() {
        let el = document.getElementById('attribute-current');
        if(!el) {
            return;
        }

        let values = el.innerHTML;
        el.remove();

        if(!values) {
            return;
        }        

        let currents = JSON.parse(values);
        currents = Object.values(currents);        

        let attributeEls = document.querySelectorAll('.attribute-value input, .attribute-value select');
        if(!attributeEls.length) {
            return;
        }

        for(let key in currents) {
            let item = currents[key];

            if(!item) {
                continue;
            }

            if(key >= attributeEls.length) {
                return;
            }

            let attributeEl = attributeEls[key];
            attributeEl.value = item;
        }
    }

    addSelect(values, number = '') {
        let parent = document.createElement('div');
        parent.classList.add('category-select');
        parent.setAttribute('data-number', number);

        let select = document.createElement('select');                
        
        this.addOption(select, 'Выберите категорию', '');

        for(let key in values) {
            this.addOption(select, values[key].name, key);
        }

        parent.append(select);
        this.container.append(parent);
    }

    addOption(parent, text, value) {
        let el = document.createElement('option');        
        el.innerHTML = text;
        el.value = value;

        parent.append(el);
    }

    change(event) {
        let select = event.target;
        if(!select || select.tagName !== 'SELECT') {
            return;
        }

        parent = select.parentElement;        
        let parentNumber = parent.dataset.number;
        this.removeElements(parentNumber);
        this.attributeManager.removeElements(parentNumber.split('-'));

        if(select.value) {
            select.name = 'categories[]';
        } else {
            select.name = '';
            return;
        }

        let currentNumber = this.getCurrentNumber(parentNumber, select.value);
        let values = this.getValues(currentNumber);
        if(Object.keys(values).length > 0) {
            this.addSelect(values, currentNumber);
        }
        
        this.attributeManager.add(select.value);
    }

    getCurrentNumber(parentNumber, currentValue) {
        if(parentNumber && currentValue) {
            return `${parentNumber}-${currentValue}`;
        } else if(currentValue) {
            return `${currentValue}`;
        } else {
            throw new Error('CategoryManager: Current number error');
        }
    }

    removeElements(number) {
        let els = this.container.querySelectorAll('.category-select');
        let found = false;

        els.forEach((el) => {
            if(el.dataset.number === number) {
                found = true;
            } else if(found) {
                el.remove();
            }
        });
    }
    
    getValues(number) {
        let numberArray = number.split('-');

        let values = this.values;
        for(let key in numberArray) {
            let index = numberArray[key];
            let item = values[index];
            if(!item) {
                throw new Error('CategoryManager: index not found');
            }
            values = item.children;
        }

        return values;
    }
}