import { useEffect, useState } from "react";
import { Link, useParams } from "react-router-dom";

const BookDetails = () => {
  const [book, setBook] = useState();
  const { BookID } = useParams();

  useEffect(() => {
    fetch(`http://localhost:8000/api/books/${BookID}`, {
      method: "GET",
    })
      .then((response) => response.json())
      .then((response) => setBook(response));
  }, [BookID]);

  if (!book) {
    return <h1>Loading...</h1>;
  }

  const handleDelete = (id) => {
    fetch(`http://localhost:8000/api/books/${id}`, { method: "DELETE"})
    .then(response => response.json())
    .then(response => {
        alert(`The Book "${response.data}" was Removed successfully`)
        window.location.href = '/'
    })
  }

  return (
    <div className="p-10 flex justify-center flex-col items-center">
      <div className="w-full flex justify-between items-center mb-16">
        <h1 className="font-bold text-7xl ">Book Details</h1>    
      </div>

      <div className="card rounded-lg  w-full">
        <div className="p-8 flex">
          <div className="context w-full">
            <h2 className="card-title mb-3 text-6xl">{book.title} </h2>
            <h3 className="italic mb-7 text-2xl">{book.author} {book.published_year}</h3>
            <p className="mb-5 text-xs">{book.description}</p>
            <p className="mb-5 text-xs italic">Genre: {book.genre}</p>
          </div>
         
          <div className="card-actions justify-end">
            <Link className=" w-full" to={`/books/${book.id}/edit`}><button className="btn w-full btn-warning">Edit</button></Link>
            <button onClick={() => handleDelete(book.id)} className="btn w-full btn-error">Delete</button>
            <Link className="w-full" to={"/"}>
                <button className="btn w-full btn-success">Homepage</button>
            </Link>
          </div>
        </div>
      </div>
    </div>
    
  );
};

export default BookDetails;
