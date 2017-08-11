import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';

class App extends React.Component {
	constructor(){
		super();
		this.state = {
			tasks : [
				// {id:1, title: "Faire la lessive"},
				// {id:2, title: "Manger", fait:true},
				// {id:3, title: "Faire prout"},
			]
		}
	}

  // On charge les données à partir du serveur : on charge les données en ajax
  componentDidMount(){
    $.get('/api/tasks', (data)=>{
      let tasks = JSON.parse(data);
      this.setState({tasks : tasks})
    });
  }

	removeItem(id){
		let found = this.state.tasks.find((elt)=>{
			return elt.id === id;
		})
		let pos = this.state.tasks.indexOf(found)
		this.state.tasks.splice(pos, 1);
		this.setState({tasks: this.state.tasks});
	}

	render(){

		return (
			<div>
				<Todo data={this.state.tasks} removeItem={this.removeItem.bind(this)} />
			</div>
			)
	}
}

class Todo extends React.Component {

	deleteTask(id){
		$.post('/api/tasks/delete', { id : id}, ()=>{
			console.log("elt supprimé sur le serveur")
		})

		this.props.removeItem(id)
	}

	render(){
		let tasks = this.props.data.map((task)=>{
			return <li>{task.name} <button onClick={()=>{this.deleteTask(task.id)}}>X</button></li>;
		});

		return (<ul>
			{tasks}
		</ul>);
	}
}

ReactDOM.render(
	<App />,
	document.querySelector("#app")
	)
