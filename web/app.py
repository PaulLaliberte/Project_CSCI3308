#This file houses all applications

#import flask from Flask module
from flask import Flask, render_template, redirect, url_for, request
from flask_bootstrap import Bootstrap


#create an instant of an application object 
app = Flask(__name__)
bootstrap = Bootstrap(app)

#Use decorator "@" and route to url
#More on decorators: http://flask.pocoo.org/docs/0.11/patterns/viewdecorators/
@app.route('/')
def home():
    return render_template('home.html')
    print "Hello"

@app.route('/sampleHTML2')
def another_page():
    return render_template('sampleHTML2.html')

@app.route('/tracking')
def tracking_page():
    return render_template('tracking.html')

#start server
if __name__ == '__main__':
    app.run(debug=True)


