using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using MySql.Data.MySqlClient;

namespace gru_lokaverk
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        public MainWindow()
        {
            InitializeComponent();
        }
    }

    public class Classes
    {
        private string _id;
        public string id
        {
            get { return _id; }
            set { _id = value; }
        }
        private string _name;
        public string name
        {
            get { return _name; }
            set { _name = value; }
        }

        private string _marks;
        public string Marks
        {
            get { return _marks; }
            set { _marks = value; }
        }
        private string _description;
        public string description
        {
            get { return _description; }
            set { _description = value; }
        }

        private string _nametoDelete;
        public string delBtn
        {
            get { return _nametoDelete; }
            set { _nametoDelete = value; }
        }
    }
}