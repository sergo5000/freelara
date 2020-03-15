export default class AttributeManager {
    constructor() {
        this.init = this.init.bind(this);

        this.values = [];
        this.container;
        this.allEls = [];

        document.addEventListener('DOMContentLoaded', this.init);
    }

    init() {
        this.container = document.getElementById('attribute-container');
        if(!this.container) {
            throw new Error('AttributeManager: Attribute container ​​not found');
        }

        let values = document.getElementById('attribute-values');
        if(!values) {
            throw new Error('AttributeManager: Attribute values ​​not found');
        }

        this.values = JSON.parse(values.innerHTML);
        values.remove();
    }

    removeElements(arrayIds) {
        this.allEls.forEach((els, i) => {
            if(els && arrayIds.indexOf(els.category_id) == -1) {
                els.array.forEach((el) => {
                    el.remove();
                });
                this.allEls[i] = null;
            }
        });
    }

    add(category_id) {
        let attributes = this.values[category_id];
        if(!attributes) {
            return;
        }

        let els = {
            category_id: category_id,
            array: [],
        };

        attributes.forEach((attribute) => {
            if(attribute.variants.length > 0 && attribute.variants[0]) {
                let el = this.addAttributeSelect(attribute);
                els.array.push(el);
            } else if(attribute.type == 'integer') {
                let el = this.addAttributeInteget(attribute);
                els.array.push(el);
            } else {
                let el = this.addAttributeString(attribute);
                els.array.push(el);
            }
        });   
        
        this.allEls.push(els);
    }

    addDiv() {
        let div = document.createElement('div');
        div.classList.add('attribute-value');
        div.classList.add('form-group');
        div.classList.add('row');
        div.classList.add('background-item');

        return div;
    }

    addLabel(parent, forId, text) {
        let label = document.createElement('label');
        label.for = 'attribute-' + forId;
        label.classList.add('col-form-label');
        label.classList.add('col-sm-3');
        label.innerHTML = text;

        parent.append(label);
    }

    addSelect(parent, id, values, required) {
        let select = document.createElement('select');
        select.id = 'attribute-' + id;
        select.name = 'attributes[' + id + ']';
        select.classList.add('form-control');

        if(required) {
            select.required = true;
        }

        this.addOption(select, '', '');
        values.forEach((value) => {
            this.addOption(select, value, value);
        });

        parent.append(select);
    }

    addOption(parent, text, value) {
        let el = document.createElement('option');        
        el.innerHTML = text;
        el.value = value;

        parent.append(el);
    }

    addInput(parent, type, id, required) {
        let input = document.createElement('input');
        input.id = 'attribute-' + id;
        input.type = type;
        input.name = 'attributes[' + id + ']';
        input.classList.add('form-control');

        if(required) {
            input.required = true;
        }

        parent.append(input);
    }

    addWrapperElement(parent) {
        let div = document.createElement('div');
        div.classList.add('col-sm-9');

        parent.append(div);

        return div;
    }

    addAttributeSelect(attribute) {
        let div = this.addDiv();       
        this.addLabel(div, attribute.id, attribute.name); 
        
        let wrapper = this.addWrapperElement(div);
        this.addSelect(wrapper, attribute.id, attribute.variants, attribute.required);
        
        this.container.append(div);

        return div;
    }

    addAttributeInteget(attribute) {
        let div = this.addDiv();
        this.addLabel(div, attribute.id, attribute.name);

        let wrapper = this.addWrapperElement(div);
        this.addInput(wrapper, 'number', attribute.id, attribute.required);
        
        this.container.append(div);

        return div;
    }

    addAttributeString(attribute) {
        let div = this.addDiv();
        this.addLabel(div, attribute.id, attribute.name);

        let wrapper = this.addWrapperElement(div);
        this.addInput(wrapper, 'text', attribute.id, attribute.required);
        
        this.container.append(div);

        return div;
    }
}