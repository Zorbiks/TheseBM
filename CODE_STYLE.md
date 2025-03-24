# CODE STYLE

This document outlines the guidelines for writing code in this project.

## Code Editor Settings
Use tabs instead of spaces for indentation.

## Coding Style

### HTML
#### Attribute Quotes
When assigning a value to an attribute, use double quotes ```"``` instead of single quotes ```'```.

**Example (Correct)**
```html
<a href="https://example.com">Example</a>
```
**Example (Incorrect)**
```html
<a href='https://example.com'>Example</a>
```

#### Self-Closing Tags
When writing self-closing tags, do not add a slash ```/``` at the end.

**Example (Correct)**
```html
<br>
```
**Example (Incorrect)**
```html
<br />
```

#### Attribute Order
Specify the id attribute first, then the class attribute, followed by any other attributes related to the tag.

**Example**
```html
<img id="avatar" class="rounded-50 p-2 m-4 border-1" src="/path/to/image.png" alt="Avatar">
```

### CSS
#### Code Organization
Always use spaces to separate blocks of code and to better organize your code, keeping things clean.

**Example (Correct)**
```css
.nav .links > a.active {
  display: block;
  font-weight: bold;
  color: red;
}

article .title-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 1rem;
}
```
**Example (Incorrect)**
```css
.nav .links>a.active{
  display: block;
  font-weight: bold;
  color: red;
}
article .title-wrapper{
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 1rem;
}
```

#### Property Grouping
Group similar properties together.

**Example (Correct)**
```css
.modal {
  display: none;
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 0%;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
}
```
**Example (Incorrect)**
```css
.modal {
  background-color: rgba(0, 0, 0, 0.5);
  justify-content: center;
  height: 100%;
  display: none;
  width: 100%;
  top: 0%;
  align-items: center;
  position: fixed;
}
```

### JavaScript
#### String Quotes
Use double quotes ```"``` instead of single quotes ```'``` when creating a string.

**Example (Correct)**
```javascript
let name = "Raoul Shehab";
```
**Example (Incorrect)**
```javascript
let name = 'Raoul Shehab';
```

#### Variable Declaration
Use the new keywords ```let``` and ```const``` when declaring variables instead of the old ```var```.

**Example (Correct)**
```javascript
let name = "Raoul Shehab";
let age = 21;
const PI = 3.14;
```

#### Naming Convention 
Use camel case with variable names containing multiple words. 

**Example (Correct)** 
```javascript
const sidebarMenuButton = ...;
function toggleActiveClass(sidebarMenuButton) {...}
```
