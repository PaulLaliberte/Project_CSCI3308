#This file houses all applications

#import flask from Flask module
from flask import Flask, render_template, redirect, url_for, request
from flask_bootstrap import Bootstrap
from flask_sqlalchemy import SQLAlchemy

#create an instant of an application object 
app = Flask(__name__)
bootstrap = Bootstrap(app)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://paul:paul@localhost/project_db'
db = SQLAlchemy(app)

class Clients(db.Model):
    __tablename__ = 'Clients'
    id = db.Column('id', db.Integer, primary_key = True)
    name = db.Column('Name', db.Unicode)
    password = db.Column('Password', db.Unicode)
    business = db.Column('Business', db.Unicode)
    latitude = db.Column('SenderLat', db.Numeric)
    longitude = db.Column('SenderLong', db.Numeric)


#Use decorator "@" and route to url
#More on decorators: http://flask.pocoo.org/docs/0.11/patterns/viewdecorators/
@app.route('/')
def home():
    return render_template('home.html')
"""
@app.route('/')
def users():
	cur = mysql.connection.cursor()
	cur.execute('''SELECT user, host FROM mysql.user''')
	rv = cur.fetchall()
	return str(rv)
"""
@app.route('/register')
def login():
     _name = request.form("name")
     _password = request.form("password")
     return render_template('register.html')

@app.route('/sampleHTML2')
def another_page():
    return render_template('sampleHTML2.html')

@app.route('/tracking')
def tracking_page():
    return render_template('tracking.html')

#start server
if __name__ == '__main__':
    app.run(debug=True)


