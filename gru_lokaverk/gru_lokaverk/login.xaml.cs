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
using System.Windows.Shapes;
using MySql.Data.MySqlClient;

namespace gru_lokaverk.tabs
{
    /// <summary>
    /// Interaction logic for login.xaml
    /// </summary>
    public partial class login : Window
    {
        sql database = new sql(); //SQL Database
        MainWindow program;

        string[] CurrentUser;
        List<string> users = new List<string>();

        public login()
        {
            try
            {
                database.ConnectToDatabase();
            }
            catch (Exception)
            {

                return;
            }
            InitializeComponent();
        }

        private void btn_signIn_Click(object sender, RoutedEventArgs e)
        {
            if (userValidation())
            {
                program = new MainWindow();
                program.Show();
                this.Close();
            }
            else if (CurrentUser[1].ToLower() == txtbox_Name.Text.ToLower() && CurrentUser[3].ToLower() == passw_box.Password.ToString().ToLower())
                MessageBox.Show("Vitlaust notendanafn og/eða lykilorð");
            else if (CurrentUser[4] != "1")
                MessageBox.Show("Því miður hefur þú ekki réttindi");
        }

        private bool userValidation()
        {
            bool valid = false;

            CurrentUser = new string[7];
            users = database.getAlldata("users", "id");
            foreach (var user in users)
            {
                CurrentUser = user.Split(';');
                if (CurrentUser[1].ToLower() == txtbox_Name.Text.ToLower() && CurrentUser[3].ToLower() == passw_box.Password.ToString().ToLower() && CurrentUser[4] == "1")
                    return true;
            }
            return valid;
        }

        private void btnRadio_NewUser_Checked(object sender, RoutedEventArgs e)
        {
            txtbox_Name.Visibility = Visibility.Hidden;
            passw_box.Visibility = Visibility.Hidden;
            lbl_Name.Visibility = Visibility.Hidden;
            lbl_Pwd.Visibility = Visibility.Hidden;
            btn_signIn.Visibility = Visibility.Hidden;

            lbl_NewName.Visibility = Visibility.Visible;
            lbl_NewPwd.Visibility = Visibility.Visible;
            lbl_NewPwd2.Visibility = Visibility.Visible;

            txtbox_NewName.Visibility = Visibility.Visible;
            pwd_Newpwd.Visibility = Visibility.Visible;
            pwd_Newpwd2.Visibility = Visibility.Visible;
        }

        private void btnRadio_ExistUser_Checked(object sender, RoutedEventArgs e)
        {
            txtbox_Name.Visibility = Visibility.Visible;
            passw_box.Visibility = Visibility.Visible;
            lbl_Name.Visibility = Visibility.Visible;
            lbl_Pwd.Visibility = Visibility.Visible;
            btn_signIn.Visibility = Visibility.Visible;

            lbl_NewName.Visibility = Visibility.Hidden;
            lbl_NewPwd.Visibility = Visibility.Hidden;
            lbl_NewPwd2.Visibility = Visibility.Hidden;

            txtbox_NewName.Visibility = Visibility.Hidden;
            pwd_Newpwd.Visibility = Visibility.Hidden;
            pwd_Newpwd2.Visibility = Visibility.Hidden;
        }

        private void btn_Close_Click(object sender, RoutedEventArgs e)
        {
            App.Current.Shutdown();
        }

        private void Btn_Mini_Click(object sender, RoutedEventArgs e)
        {
            WindowState = WindowState.Minimized;
        }

        private void Window_Loaded(object sender, RoutedEventArgs e)
        {
            txtbox_Name.Focus();
        }
    }
}
