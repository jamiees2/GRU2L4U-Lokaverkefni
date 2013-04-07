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


        public void ConnectToDatabase()
        {
            server = "nocando.unix.is";
            database = "gru2013";
            uid = "gru_user";
            password = "Xu9C6pQLce6tL2ey";

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
      





    }
}
