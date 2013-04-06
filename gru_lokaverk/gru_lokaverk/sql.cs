using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using MySql.Data.MySqlClient;
using System.Windows;

namespace gru_lokaverk
{
    public class sql
    {
        private string server;
        private string database;
        private string uid;
        private string password;
        string connectionstring = null;
        string query = null;

        MySqlConnection sqlConnection;
        MySqlCommand newSqlQuery;
        MySqlDataReader sqlReader = null;


        public void TengingvidGagnagrunn()
        {
            server = "127.0.0.1"; //127.0.0.1
            database = "forritun";
            uid = "for";
            password = "for";

            connectionstring = "server=" + server + ";userid=" + uid + ";password=" + password + ";database=" + database;
            sqlConnection = new MySqlConnection(connectionstring);
        }
        private bool OpenConnection()
        {
            try
            {
                sqlConnection.Open();
                return true;
            }
            catch (Exception ex)
            {
                
                throw ex;
            }
        }
        private bool CloseConnection()
        {
            try
            {
                sqlConnection.Close();
                return true;
            }
            catch (Exception ex)
            {
                
                throw ex;
            }
        }
        public void SettinnSqlToflu(string book_name,string isdn_number,string quantity,string about)
        {
            if (OpenConnection()==true)
            {
                query = "INSERT INTO books(id,book_name, isdn_number,quantity,about) VALUES('','"+book_name+"','"+isdn_number+"','"+quantity+"','"+about+"')";
                //Create command and assign the query(fyrirspurn) and connection (tenginguna) from the constructor
                newSqlQuery = new MySqlCommand(query, sqlConnection);
                //ExecuteNonQuery: used to execute a command that will not return any data
                newSqlQuery.ExecuteNonQuery();
                CloseConnection();
            }
        }
        public string FinnaEinstakling(string id)
        {
            string lina = null;
            if (OpenConnection()==true)
            {
                query = "SELECT id, book_name,isdn_number, quantity, about FROM books WHERE id='" + id + "'";
                newSqlQuery = new MySqlCommand(query, sqlConnection);
                sqlReader = newSqlQuery.ExecuteReader();
                while (sqlReader.Read())
                {
                  
                    for (int i = 0; i < sqlReader.FieldCount; i++)
                    {
                        lina += (sqlReader.GetValue(i).ToString()) + ":";
                    }
                }
                sqlConnection.Close();
            }
            return lina;
        }


        //Eyðir út ákveðnum einstakling
        public void Eyda(string id)
        {
            if (OpenConnection()==true)
            {
                query = "DELETE FROM books WHERE id='" + id + "'";
                newSqlQuery = new MySqlCommand(query, sqlConnection);
                newSqlQuery.ExecuteNonQuery();
                CloseConnection();
            }
        }

        //Uppfærir ákveðinn einstakling
        public void Update(string id, string book_name, string isdn_number, string quantity, string about)
        {
            if (OpenConnection()==true)
            {
                query = "Update books SET id='" + id + "', book_name='" + book_name + "',isdn_number='" + isdn_number + "',quantity='" + quantity + "',about='"+about+"' WHERE id='" + id + "'";
                newSqlQuery = new MySqlCommand(query, sqlConnection);
                newSqlQuery.ExecuteNonQuery();
                CloseConnection();
            }
        }

        //Þessi aðferð les úr SQL gagnagrunni allar færslu og birtir í viðeigandi töflu
        public List<string> LesaUtSQLToflu()
        {
            List<string> Faerslur = new List<string>();
            string lina = null;
            if (OpenConnection()==true)
            {
                query = "SELECT * FROM books";
                newSqlQuery = new MySqlCommand(query, sqlConnection);
                //ExecuteReader: Used to execute a command that will return 0 or more records
                sqlReader = newSqlQuery.ExecuteReader();
                while (sqlReader.Read())
                {
                 // MessageBox.Show(sqlLesari.ToString());
                    for (int i = 0; i < sqlReader.FieldCount; i++)
                    {
                        lina += (sqlReader.GetValue(i).ToString()) + ":";
                    }
                    Faerslur.Add(lina);
                    lina = null;
                }
                CloseConnection();
                return Faerslur;
            }
            return Faerslur;//Skilar fyrri Faerslum ef Connection ==false
        }

        //Hérna er fundinn ákveðin einstaklingur og gögnin hans koma til baka



        //Geri mér grein fyrir því að það verður vesen ef fleiri en einn hafa eins lykilorð. En það var beðið um þetta í lýsingu verkefnisins

        public string[] FinnaAkvedinnogSkila(string pass)
        {
            string[] gogn = new string[4];
            if (OpenConnection()==true)
            {
                query = "SELECT id,name,pass FROM admins WHERE pass='" + pass + "'";
                newSqlQuery = new MySqlCommand(query, sqlConnection);
                sqlReader = newSqlQuery.ExecuteReader();
                while (sqlReader.Read())
                {
                    gogn[0] = sqlReader.GetValue(0).ToString();//id komið hingað
                    gogn[1] = sqlReader.GetValue(1).ToString();//Name komið hingað
                    gogn[2] = sqlReader.GetValue(2).ToString();//passwordið komið hingað
                }
                sqlReader.Close();
                CloseConnection();
                return gogn;
            }
            return gogn;
        }      
    }
}
